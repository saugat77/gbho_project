<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewOrderRequest;
use App\Service\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

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
            DB::commit();
            Cart::destroy();
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
        } catch (\Throwable $th) {
            DB::rollBack();
            logger('Error While placing order.');
            report($th);
            return redirect()->back()->with('error', 'Sorry something went wrong while placing your order. Please try again.');
        }

        if ($order->payment_method == 'paypal') {
            return redirect()->route('paypal.pay', $order);
        }

        return redirect()->route('frontend.orders.index')->with('success', 'Your order has been placed and is being processed');
    }
}
