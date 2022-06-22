@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5 px-0 sm:px-4">
    <div class="">
        <h3 class="text-lg text-gray-900 text-center font-medium font-poppins tracking-wide relaxed-8 mb-4">Checkout</h3>
        <div class="px-4 pb-2">
            {{-- @include('alerts.tailwind.all') --}}
            @if(Session::has('error'))
            <div class="bg-red-200 text-red-800 border border-red-600 p-2 rounded font-sans"">
                {{ Session::get('error') }}
            </div>
            @endif
            @if(Session::has('success'))
            <div class=" bg-green-200 text-green-800 border border-green-600 p-2 rounded font-sans">
                {{ Session::get('success') }}
            </div>
            @endif
        </div>
        <form action=" {{ route('frontend.orders.store') }}" class="form" method="POST">
            @csrf
            <div>
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-8">
                        <div class="bg-white rounded p-3">
                            <h4 class="text-lg text-blue-900 mb-3">Shipping Information</h4>
                            <div class="flex flex-wrap -mx-2 -mb-4">

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label class="required">Name</x-form.tailwind-label>
                                    <input name="billing[name]" class="form-input w-full {{ invalid_class('billing.name', 'tailwind') }}" value="{{ old('billing.name', $user->name) }}">
                                    <x-tailwind-invalid-feedback field="billing.name"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label class="required">Email</x-form.tailwind-label>
                                    <input name="billing[email]" class="form-input w-full {{ invalid_class('billing.email', 'tailwind') }}" value="{{ old('billing.email', $user->email) }}">
                                    <x-tailwind-invalid-feedback field="billing.email"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label class="required">Mobile</x-form.tailwind-label>
                                    <input name="billing[mobile]" class="form-input w-full {{ invalid_class('billing.mobile', 'tailwind') }}" value="{{ old('billing.mobile', $user->mobile) ?? isset($lastShippingAddress->mobile) ? $lastShippingAddress->mobile : null }}">
                                    <x-tailwind-invalid-feedback field="billing.mobile"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label>Region</x-form.tailwind-label>
                                    <input name="billing[region]" class="form-input w-full {{ invalid_class('billing.region', 'tailwind') }}" value="{{ old('billing.region', $user->address->region) ?? isset($lastShippingAddress->region) ? $lastShippingAddress->region : null }}">
                                    <x-tailwind-invalid-feedback field="billing.region"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label>City</x-form.tailwind-label>
                                    <input name="billing[city]" class="form-input w-full {{ invalid_class('billing.city', 'tailwind') }}" value="{{ old('billing.city', $user->address->city) ?? isset($lastShippingAddress->city) ? $lastShippingAddress->city : null }}">
                                    <x-tailwind-invalid-feedback field="billing.city"></x-tailwind-invalid-feedback>
                                </div>


                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label class="required">Address Line One</x-form.tailwind-label>
                                    <input name="billing[address_line_one]" class="form-input w-full {{ invalid_class('billing.address_line_one', 'tailwind') }}" value="{{ old('billing.address_line_one', $user->address->address_line_one) ?? isset($lastShippingAddress->address_line_one) ? $lastShippingAddress->address_line_one : null }}">
                                    <x-tailwind-invalid-feedback field="billing.address_line_one"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <x-form.tailwind-label>Address Line Two</x-form.tailwind-label>
                                    <input name="billing[address_line_two]" class="form-input w-full {{ invalid_class('billing.address_line_two', 'tailwind') }}" value="{{ old('billing.address_line_two', $user->address->address_line_two) ?? isset($lastShippingAddress->address_line_two) ? $lastShippingAddress->address_line_two : null }}">
                                    <x-tailwind-invalid-feedback field="billing.address_line_two"></x-tailwind-invalid-feedback>
                                </div>

                                <div class="w-full md:w-12/12 px-2 mb-4">
                                    <x-form.tailwind-label>Order Notes</x-form.tailwind-label>
                                    <textarea name="order[notes]" class="form-textarea w-full {{ invalid_class('order.notes', 'tailwind') }}" rows="3">{{ old('order.notes') }}</textarea>
                                    <x-tailwind-invalid-feedback field="order.notes"></x-tailwind-invalid-feedback>
                                </div>

                            </div>
                            {{-- End of form-row --}}
                        </div>
                    </div>
                    {{-- End of col-md-8 --}}
                    <div class="col-span-12 sm:col-span-4">
                        <div class="bg-white rounded p-3">
                            <h4 class="text-lg text-blue-900 mb-3">Your Order</h4>
                            <table class="table-auto text-sm w-full">
                                <thead class="border-b">
                                    <tr class="">
                                        <th class="py-2 font-medium text-gray-700 text-left">Product</th>
                                        <th class="py-2 font-medium text-gray-700 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="border-b">
                                    <?php foreach($cartProducts as $row) :?>
                                    <tr>
                                        <td class="py-2">
                                            <div class=""><?php echo $row->name; ?></div>
                                        </td>
                                        <td class="py-2 text-right">{{ formatted_price($row->subtotal) }}</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="py-2">Delivery Cost</td>
                                        <td class="py-2 text-right">{{ formatted_price($shippingCharge) }}</td>
                                    </tr>
                                    @if (session()->has('coupon'))
                                    <tr>
                                        <td class="py-2">Discount (Coupon: {{ session()->get('coupon')['code'] }})</td>
                                        <td class="py-2 text-right text-green-600">-{{ formatted_price(session()->get('coupon')['discount']) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="border-t">
                                        <td class="py-2">Total</td>
                                        <td class="py-2 text-right">{{ formatted_price($total) }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            @if (!session()->has('coupon'))
                            <div class="bg-white rounded mt-4">
                                <x-form.tailwind-label>Coupon Code</x-form.tailwind-label>
                                <div class="flex items-center">
                                    <input id="coupon-code" class="form-input w-full rounded-r-none {{ invalid_class('coupon', 'tailwind') }}" value="{{ old('coupon', ) }}" onkeydown="return event.key != 'Enter';">
                                    <button type="button" onclick="applyCoupon()" class="py-2 px-3 bg-blue-600 text-white border border-blue-600 rounded-r">Apply</button>
                                </div>
                                <x-tailwind-invalid-feedback field="coupon"></x-tailwind-invalid-feedback>
                            </div>
                            @endif

                            <div class="my-3"></div>

                            <label class="block bg-gray-200 rounded p-3">
                                <div class="inline-flex gap-4 items-center">
                                    <input type="radio" name="order[payment_method]" class="form-radio" value="cod" checked>
                                    <div>
                                        <span class="">Cash On Delivery</span>
                                        <div class="text-xs text-gray-700">Pay cash upon delivery</div>
                                    </div>
                                </div>
                            </label>
                            <div class="h-5"></div>
                            <label class="block bg-gray-200 rounded p-3">
                                <div class="inline-flex gap-4 items-center">
                                    <input type="radio" name="order[payment_method]" class="form-radio" value="paypal">
                                    <div>
                                        <span class="">Paypal</span>
                                        <div class="text-xs text-gray-700">You will be redirected to paypal</div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="bg-white rounded p-3 mt-4">
                            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white hover:shadow focus:shadow-outline p-3 rounded w-full">Place order</button>
                        </div>

                    </div>
                    {{-- End of col-md-4 --}}
                </div>
                {{-- End of row --}}
            </div>
        </form>
    </div>

    <form id="coupon-form" action="{{ route('apply-coupon') }}" method="POST">
        @csrf
    </form>
</div>
@endsection

@push('styles')
<script>
    function applyCoupon() {
        var couponForm = document.getElementById('coupon-form');
        let code = document.getElementById('coupon-code').value;
        let couponField = document.createElement('input');
        couponField.setAttribute('type', 'hidden');
        couponField.setAttribute("name", 'code');
        couponField.setAttribute("value", code);
        couponForm.appendChild(couponField);
        couponForm.submit();
    }

</script>
@endpush
