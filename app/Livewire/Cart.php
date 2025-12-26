<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;

    protected $listeners = ['cart-updated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    /**
     * Remove a cart item.
     */
    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);

        // Security check: ensure the item belongs to the authenticated user
        if ($cartItem->user_id !== Auth::id()) {
            return;
        }

        $cartItem->delete();

        $this->loadCart();
        $this->dispatch('cart-updated');

        session()->flash('message', 'Item removed from cart.');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateQty($itemId, $newQuantity)
    {
        $cartItem = CartItem::findOrFail($itemId);

        // Security check: ensure the item belongs to the authenticated user
        if ($cartItem->user_id !== Auth::id()) {
            return;
        }

        $quantity = max(1, (int) $newQuantity); // Enforce minimum of 1

        // Optional stock check (recommended to prevent overselling)
        $availableStock = $cartItem->product->stock_quantity;
        if ($quantity > $availableStock) {
            session()->flash('error', "Only {$availableStock} item(s) in stock.");
            $quantity = $availableStock;
            $cartItem->update(['quantity' => $quantity]);
        } else {
            $cartItem->update(['quantity' => $quantity]);
            session()->flash('message', 'Quantity updated.');
        }

        // If quantity was set below 1 (e.g., via direct manipulation), remove the item
        if ($newQuantity < 1) {
            $cartItem->delete();
            session()->flash('message', 'Item removed from cart.');
        }

        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.app');
    }
}
