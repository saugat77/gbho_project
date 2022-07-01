<?php

namespace App\Service;

use App\Order;
use App\OrderProduct;
use App\Package;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function saveOrderItems(Order $order)
    {
        $products = [];
        foreach (Cart::content() as $item) {
            $product = [
<<<<<<< HEAD
                'userid' => $item->name,
=======
                'name' => $item->name,
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
                'store_id' => $item->options->store_id,
            ];
            array_push($products, $product);
        }

        $packages = collect($products)->groupBy('store_id');

        $packages->each(function ($package, $storeId) use ($order, $products) {

            $packagePrice = 0;
            foreach ($package as $product) {
                $packagePrice += $product['price'];
            }

            $newPackage = Package::create([
                'order_id' => $order->id,
                'store_id' => $storeId,
                'sub_total_price' => $packagePrice,
                'status' => 'pending'
            ]);

            $products = $package->map(function ($product) use ($newPackage) {
                $product = [
                    'name' => $product['name'],
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'package_id' => $newPackage->id,
                    'created_at' =>  \Carbon\Carbon::now()
                ];
                return $product;
            });
            OrderProduct::insert($products->toArray());
        });
    }

    public function createOrder($paymentMethod)
    {
            $order = Order::create(
                [
                    'user_id' => auth()->id(),
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'pending',
                    'status' => 'pending',
                    'subtotal_price' => Cart::total(0, '', ''),
                    'shipping_charge' => shippingCharge(),
                    'discount_amount' => session()->get('coupon')['discount'] ?? 0,
                    'total_price' => Cart::total(0, '', ''),
                    'notes' => request('order')['notes'] ?? null
                ]
            );

            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'name' => $item->name,
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
            };

           return $order;
    }

    public function storeAddress($order, array $data)
    {
        $order->address()->create($data);
    }
}
