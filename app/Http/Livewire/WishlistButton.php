<?php

namespace App\Http\Livewire;

use App\Product;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistButton extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function toggle()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if ($this->product->wishlisted()) {
            $this->product->removeFromWishlist();
            $this->emit('toast', ['default', 'Removed from wishlist']);
        } else {
            $this->product->addToWishlist();
            $this->emit('toast', ['default', 'Added to wishlist']);
        }
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
