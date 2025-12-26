<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartBadge extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cart-updated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->cartCount = CartItem::where('user_id', Auth::id())
            ->sum('quantity') ?? 0;
    }

    public function render()
    {
        return view('livewire.cart-badge');
    }
}
