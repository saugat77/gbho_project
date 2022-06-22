<?php

namespace App\Http\Controllers;

use App\Order;
use Exception;
use Illuminate\Http\Request;
use Omnipay\Omnipay;


class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(settings('paypal_client_id'));
        $this->gateway->setSecret(settings('paypal_api_secret'));
        $this->gateway->setTestMode(settings('paypal_enable_test_mode') == 'yes');
    }

    public function pay(Order $order)
    {
        try {
            if ($order->payment_status == 'paid') {
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

    public function success(Request $request)
    {
        try {
            // $request->validate([
            //     'order_id' => 'required|exists:orders,id',
            //     'paymentId' => 'required',
            //     'token' => 'required',
            //     'PayerID' => 'required'
            // ]);


            $order = Order::findOrFail($request->order_id);

            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->PayerID,
                // 'transactionReference' => $request->paymentId,
                'transactionReference' => $order->paypal_transaction_id, // For security reason we are taking transaction ID from datbase
            ]);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $order->update([
                    'payment_status' => 'paid'
                ]);
                return redirect()->route('frontend.orders.index')->with('success', 'Payment success for order #' . $order->id . '.');
            }

            throw new Exception('Something went wrong while processing your payment.');
        } catch (\Throwable $th) {
            report($th);
            return redirect()->route('frontend.orders.index')->with('error', 'Something went wrong while processing your payment.');
        }
    }

    public function cancelled()
    {
        return redirect()->route('frontend.orders.index')->with('error', 'Sorry the payment has been cancelled.');
    }
}
