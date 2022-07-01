<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalControllerBak extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->middleware('auth');
        $this->provider = new ExpressCheckout();
    }

    public function expressCheckout(Order $order)
    {
        // TODO::Validate payment
        $orderedProducts = $order->products->map(function ($item) {
            return [
                'name' => $item->name,
                'price' => $item->price,
                'desc' => '',
                'qty' => $item->quantity,
            ];
        });

        // add shipping if applies
        if ($order->shipping_charge) {
            $shipping = array([
                'name' => 'shipping',
                'price' => $order->shipping_charge
            ]);
            $orderedProducts = array_merge($orderedProducts->toArray(), $shipping);
        }

        $payment['items'] = $orderedProducts;
        $payment['invoice_id'] = uniqid();
        $payment['invoice_description'] = "Order #{$order['id']} Bill";
        $payment['return_url'] = route('paypal.express-checkout.success');
        $payment['cancel_url'] = route('paypal.express-checkout.cancel');
        $payment['total'] = $order->price_with_shipping;

        $res = $this->provider->setExpressCheckout($payment, true);

        // update order
        $order->invoice_number = $payment['invoice_id'];
        $order->save();

        return $res;

        return redirect($res['paypal_link']);
    }

    public function expressCheckoutSuccess(Request $request)
    {
        $token = $request->get('token');
        $response = $this->provider->getExpressCheckoutDetails($token);
        $invoiceNumber = $response['INVNUM'];

        // if response ACK value is SUCCESS or SUCCESSWITHWARNING
        // we update the payment status
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Order::where('invoice_number', $invoiceNumber)->update([
                'payment_status' => 'completed',
                'paypal_response' => json_encode($response)
                ]);

            return redirect()->route('frontend.orders.index')->with('success', 'Your order has been placed and is being processed');
        }

        dd('Error processing PayPal payment');
        return redirect()->route('frontend.orders.index')->with(['error' => 'Error processing PayPal payment']);
    }

    public function expressCheckoutCancel()
    {
        return redirect()->route('frontend.orders.index')->with('error', 'Please process the payment to complete your order');
    }
}
