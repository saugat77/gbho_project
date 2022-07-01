<?php

namespace App\Http\Livewire;

use App\Order;
use Livewire\Component;

class UpdateOrderPayment extends Component
{
    public $order;
    protected $rules = [
        'order.payment_status' => 'required',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function updatePaymentStatus()
    {
        $this->validate();
        $this->order->save();

        $this->emit('orderPaymentStatusUpdated');
        $this->emit('toast', ['success', 'Payment status changed']);
    }


    public function render()
    {
        return view('livewire.update-order-payment');
    }
}
