<?php

namespace App\Livewire;

use App\Jobs\LowStockNotificationJob;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductList extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function addToCart($productId)
    {
        try {
            $product = Product::findOrFail($productId);

            if ($product->stock_quantity <= 0) {
                session()->flash('error', 'Product out of stock!');

                return;
            }

            CartItem::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $productId],
                ['quantity' => DB::raw('quantity + 1')]
            );

            // Reload the cart item to get the updated quantity
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem && ($product->stock_quantity - $cartItem->quantity) <= 335) {
                LowStockNotificationJob::dispatch($product);
            }

            session()->flash('message', 'Product successfully added to cart.');

            // Dispatch event to update cart badge in real-time
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add product to cart. Please try again.');
        }
    }

    public function render()
    {
        // dd($this->products);
        return view('livewire.product-list')->layout('layouts.app');
    }
}
