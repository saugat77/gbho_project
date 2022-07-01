<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewOrderRequest;
use App\Service\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;
=======

>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth');
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('frontend.order.index', [
            'heading' => 'My Orders'
        ]);
    }

    public function storeOld(NewOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $order = $request->persistOrder();
            $this->orderService->saveOrderItems($order);
<<<<<<< HEAD
          
            DB::commit();

            Cart::destroy();
       
=======
            DB::commit();
            Cart::destroy();
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
        } catch (\throwable $ex) {
            DB::rollBack();
            logger('Error While persisting order.');
            report($ex);
            return $ex->getMessage();
        }

        if ($order->payment_method == 'paypal') {
            return redirect()->route('paypal.express-checkout', $order);
        }

        return redirect()->route('frontend.orders.index')->with('success', 'Your order has been placed and is being processed');
    }

    public function store(NewOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $order = $this->orderService->createOrder($request->order['payment_method']);
            $this->orderService->storeAddress($order, $request->billing);
            DB::commit();
            Cart::destroy();
<<<<<<< HEAD
            
=======
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
        } catch (\Throwable $th) {
            DB::rollBack();
            logger('Error While placing order.');
            report($th);
            return redirect()->back()->with('error', 'Sorry something went wrong while placing your order. Please try again.');
        }

        if ($order->payment_method == 'paypal') {
<<<<<<< HEAD
        //    return  $order->id ;

            print_r('Showing the user profile for user: '.$order);
        //  return redirect()->route('paypal.pay', $order);
=======
            return redirect()->route('paypal.pay', $order);
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
        }

        return redirect()->route('frontend.orders.index')->with('success', 'Your order has been placed and is being processed');
    }
}
