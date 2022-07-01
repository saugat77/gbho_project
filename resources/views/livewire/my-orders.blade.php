<div>
    @foreach($orders as $order)
    <div class="border rounded mb-4">
        <div class="flex p-3">
            <div>
                <div>
                    Order <span class="font-nunito font-bold tracking-wide uppercase">#{{ $order->id }}</span>
                </div>
                <div class="text-xs text-gray-600">
                    Placed on {{ $order->created_at->isoFormat('lll') }}
                </div>
            </div>
            <div class="ml-auto">
                @if ($order->payment_method == 'paypal' && $order->payment_status == 'pending' && $order->status != 'cancelled')
                <a class="py-2 px-4 text-sm rounded bg-blue-500 text-white hover:bg-blue-400" href="{{ route('paypal.pay', $order->id) }}">Pay Now</a>
                @endif
            </div>
        </div>
        <div class="text-gray-700 border-t border-b border-dashed text-sm py-2 px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <div>Order Status: <span class="capitalize">{{ $order->status }}</span></div>
                    @if ($order->status != 'cancelled')
                    <div>Payment: <span class="capitalize">{{ $order->payment_method }} ({{ $order->payment_status }})</span></div>
                    @endif
                </div>
                <div class="text-right">
                    <div>Total Price: {{ formatted_price($order->billAmount()) }}</div>
                </div>
            </div>
        </div>
        <div class="p-3">
            <table class="table-auto w-full text-gray-800">
                @foreach($order->products as $product)
                <tr>
                    <td class="px-4 py-2 font-nunito">
                        <div class="flex items-center">
                            @if($product->product->featuredImage)
                            <img class="h-10 w-10 sm:h-16 sm:w-16" src="{{ $product->product->small_featured_image_url }}">
                            @endif
                            <div class="ml-3 sm:ml-4">
                                <div class="">{{ $product->name }}</div>
                                @if($order->status == 'completed' && $product->product)
                                <div>
                                    <a href="{{ route('frontend.products.show', $product->product) }}?rate-now=true" class="py-1 text-blue-600 font-semibold text-sm rounded hover:underline">Rate Product</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2 text-right">{{ formatted_price($product->price) }} x {{ $product->quantity }}</td>
                </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="2" class="px-4 text-right">
                            Delivery Cost: {{ formatted_price($order->shipping_charge) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-4 text-right">
                            Discount: {{ formatted_price($order->discount_amount) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-4 text-right">
                            Total: {{ formatted_price($order->billAmount()) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endforeach

    @if ($orders->hasPages())
    {{ $orders->links() }}
    @endif
</div>
