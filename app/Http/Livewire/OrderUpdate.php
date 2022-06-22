<?php

namespace App\Http\Livewire;

use App\Order;
use Livewire\Component;

class OrderUpdate extends Component
{
    public $order;
    protected $rules = [
        'order.status' => 'required',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function updateOrder()
    {
        $this->validate();
        // if order status is changed to confirmed
        if ($this->order->isDirty('status')  && $this->order->status == 'processing') {
            // decrement the product stock
            foreach ($this->order->products as $orderProduct) {
                if ($orderProduct->product->manage_stock) {
                    $orderProduct->product->decrement('stock_quantity', $orderProduct->quantity);
                }
            }
        }

        $this->order->save();

        $this->emit('orderUpdated');
        $this->emit('toast', ['success', 'Order status changed']);
    }

    public function render()
    {
        return view('livewire.order-update');
    }
}
