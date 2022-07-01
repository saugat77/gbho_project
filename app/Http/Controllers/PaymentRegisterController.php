<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout; 

use Illuminate\Http\Request;


class PaymentRegisterController extends Controller
{
    private $gateway;

    public function __construct()
    {
       
      $this->provider = new ExpressCheckout();
    }
 
    public function pay(User $order)
    {
        try {
            if ($order->payment_status == '1') {
                return back()->with('success', 'You have already paid for this order.');
            }

            $response = $this->gateway->purchase(
                array(
                    'amount' => $order->total_price,
                    'currency' => settings('paypal_currency', 'USD'),
                    'returnUrl' => route('paypal.success', ['order_id' => $order->id]),
                    'cancelUrl' => route('paypal.cancelled', ['order_id' => $order->id]),
                    'description' => 'Order #' . $order->id,
                    // "items" => array(
                    //     [
                    //         'name' => 'Item Name',
                    //         'price' => '10',
                    //         'quantity' => 1,
                    //     ]
                    // )
                )
            )->send();

            $order->update([
                'paypal_transaction_id' => $response->getData()['id']
            ]);
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->route('frontend.orders.index')->with('error', 'Something went wrong while setting up payment.');
        }
    }
}
