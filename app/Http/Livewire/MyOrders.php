<?php

namespace App\Http\Livewire;

use App\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.my-orders', [
            'orders' => Order::latest()->paginate(5)
        ]);
    }
}
