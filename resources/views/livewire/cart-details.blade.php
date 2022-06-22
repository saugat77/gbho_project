<div class="font-nunito">
    @if(count($cartProducts))
    <div class="md:flex md:-m-5">
        <div class="w-full md:w-8/12 md:px-5 sm:py-4">
            <div class="bg-white">
                <div class="flex items-center p-2">
                    <h3 class="text-lg font-semibold font-sans">My Cart ({{ Cart::count() }})</h3>
                    <div class="ml-auto">
                        <a class="inline-block sm:hidden bg-primary border border-primary hover:bg-transparent hover:text-primary hover:shadow-lg focus:shadow-outline py-2 px-5 text-white rounded-sm" href="{{ route('frontend.checkout.index') }}">Checkout</a>
                    </div>
                </div>
                @foreach($cartProducts as $item)
                <div class="border-t p-4">
                    <div class="flex gap-4  sm:gap-5">
                        <div class="py-2">
                            <div class="aspect-w-1 aspect-h-1 w-24">
                                <img class="w-full h-full object-cover object-center rounded-sm" src="{{ $item->model->featured_image_url }}">
                            </div>
                        </div>
                        <div class="flex-grow py-2 font-nunito">
                            <a class="block hover:text-primary sm:text-lg sm:mb-2" href="{{ route('frontend.products.show', $item->model->slug) }}">{{ ucfirst($item->model->name) }}</a>
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm text-gray-600 opacity-75 sm:my-2">
                                        Quantity: {{ $item->qty}} pcs
                                    </div>
                                    <div class="text-gray-900 font-bold">
                                        {{ priceUnit() }} {{ number_format($item->model->current_price) }}
                                    </div>
                                    @if ($item->model->hasDiscount())
                                    <div class="text-sm">
                                        <span class="text-gray-800 opacity-75 line-through">
                                            {{ priceUnit() }} {{ number_format($item->model->regular_price) }}
                                        </span>
                                        <span class="mx-2 text-green-600 font-semibold text-sm"> {{ $item->model->discountPercentage() }} Off</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-auto">
                                    <button wire:click="removeItem('{{ $item->rowId }}')" class="font-semibold text-red-500 text-sm bg-red-100 py-1 px-2 rounded-sm hover:text-primary tracking-wide uppercase">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="p-4 flex shadow-xs">
                    <a class="inline-block bg-red-600 border  border-red-600 hover:bg-transparent hover:text-red-600 hover:shadow-lg focus:shadow-outline py-2 px-3 text-white rounded-sm mr-2" href="{{ url()->previous() }}">Continue Shopping</a>
                <a class="ml-auto inline-block bg-primary border border-primary hover:bg-transparent hover:text-primary hover:shadow-lg focus:shadow-outline py-2 px-5 text-white rounded-sm" href="{{ route('frontend.checkout.index') }}">Place Order</a>
            </div> --}}
        </div>
    </div>
    <div class="w-full md:w-4/12 md:px-5 py-4">
        <div class="bg-white">
            <h3 class="text-lg font-semibold font-sans p-4 border-b">Price Details</h3>
            <div class="p-4 pt-0">
                <table class="w-full">
                    <tr>
                        <td class="py-2 text-gray-800 font-semibold">Subtotal ({{ Cart::count() }} items)</td>
                        <td class="py-2 text-right">{{ priceUnit() }} {{ Cart::priceTotal(0) }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-800 font-semibold">Discount</td>
                        <td class="py-2 text-green-600 text-right">- {{ priceUnit() }} 0</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-800 font-semibold">Delivery Cost</td>
                        <td class="py-2 text-right">{{ priceUnit() }} {{ shippingCharge() }}</td>
                    </tr>
                    <tr class="border-t border-b border-dashed">
                        <td class="py-2 text-gray-800 font-semibold">Total Amount</td>
                        <td class="py-2 font-bold text-right">{{ priceUnit() }} {{ number_format((int)Cart::total(0, '', '') + shippingCharge()) }}</td>
                    </tr>
                </table>
                <a class="mt-3 block text-center bg-primary border border-primary hover:bg-transparent hover:text-primary hover:shadow-lg focus:shadow-outline py-2 px-5 text-white rounded-sm" href="{{ route('frontend.checkout.index') }}">Proceed to checkout</a>
            </div>
        </div>
    </div>
</div>
<br>
@else
<div class="w-full flex items-center sm:py-5">
    <div class="container flex flex-col items-center justify-center p-5 text-gray-700">
        <div>
            <img class="h-32 md:h-64 w-auto" src="{{ asset('assets/img/empty-cart.png') }}" alt="{{ __('Empty Cart') }}">
        </div>
        <div class="max-w-md text-center">
            <div class="text-2xl md:text-4xl font-dark font-bold">
                <span>Your cart is empty</span>
            </div>
            <p class="mb-5">Looks like you haven't made your choice yet.</p>
            <a href="{{ route('home') }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent focus:outline-none focus:shadow-outline-blue bg-primary active:bg-blue-600 hover:bg-secondary rounded">Back to Homepage</a>
        </div>
    </div>
</div>
@endif
</div>
