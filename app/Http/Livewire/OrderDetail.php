<?php

namespace App\Http\Livewire;

use App\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;
    protected $listeners = ['orderUpdated', 'orderPaymentStatusUpdated'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function orderUpdated()
    {
        // Refresh on event
    }

    public function orderPaymentStatusUpdated()
    {
        // Refresh on event
    }

    public function render()
    {
        $this->order->load('products.product', 'address');
        return view('livewire.order-detail');
    }
}
