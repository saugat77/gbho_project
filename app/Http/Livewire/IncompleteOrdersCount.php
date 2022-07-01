<?php

namespace App\Http\Livewire;

use App\Order;
use Livewire\Component;

class IncompleteOrdersCount extends Component
{
    protected $listeners = ['orderUpdated'];

    public function orderUpdated()
    {
        // reloads on its own
    }

    public function render()
    {
        $count = Order::whereNotIn('status', ['completed', 'cancelled', 'refunded'])->count();

        return view('livewire.incomplete-orders-count', [
            'count' => $count
        ]);
    }
}
