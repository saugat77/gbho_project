<div class="row">
    <div class="col-md-8">
        @include('order.status-cards')

        <x-box class="rounded">
            <div class="d-flex">
                <div class="align-self-center">
                    <h5 class="h5-reponsive d-inline-block mdb-color-text">Order ID: {{ $order->id }}</h5>
                    <div class="text-muted">{{ $order->created_at->isoFormat('lll') }}</div>
                </div>
                <div class="align-self-center ml-auto">
                    <a href="{{ route('invoices.create', $order) }}" class="btn btn-light my-0 border font-poppins text-capitalize" target="_blank">Print Invoice</a>
                </div>
            </div>
            <div class="my-3"></div>
            <table class="table white border font-poppins table-responsive-sm">
                <thead class="bg-light">
                    <tr class="mdb-color-text">
                        <th>#</th>
                        <th>PRODUCT</th>
                        <th>UNIT PRICE</th>
                        <th>QUANTITY</th>
                        <th class="text-right">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $item)
                    <tr>
                        <td class="font-medium mdb-color-text">{{ $loop->iteration }}</td>
                        <td>
                            <a class="d-block text-success font-weight-bolder" href="{{ route('frontend.products.show', $item->product) }}" target="_blank">{{ $item->name }}</a>
                            @if($item->sku)
                            <div class="text-muted font-poppins">SKU: {{ $item->product->sku }}</div>
                            @endif
                        </td>
                        <td>{{ priceUnit() }} {{ number_format($item->price) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-right">{{ priceUnit() }} {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="font-poppins text-right px-3">
                <div style="gap: 1rem;">
                    <span>Subtotal</span>
                    <span class="d-inline-block ml-4" style="min-width: 50px;">{{ priceUnit() }} {{ number_format($order->total_price) }}</span>
                </div>
                <div class="" style="gap: 1rem;">
                    <span>Discount</span>
                    <span class="d-inline-block ml-4" style="min-width: 50px;">{{ priceUnit() }} {{ number_format($order->discount_amount) }}</span>
                </div>
                <div class="" style="gap: 1rem;">
                    <span>Shipping Cost</span>
                    <span class="d-inline-block ml-4" style="min-width: 50px;">{{ priceUnit() }} {{ number_format($order->shipping_charge) }}</span>
                </div>
                <div class="" style="gap: 1rem;">
                    <span>Total</span>
                    <span class="d-inline-block ml-4" style="min-width: 50px;">{{ priceUnit() }} {{ number_format($order->billAmount()) }}</span>
                </div>
            </div>
            <div class="text-muted">
                Last Updated By: {{ $order->editor->name }}
            </div>
        </x-box>

        @if($order->notes)
        <x-box class="mt-3 rounded">
            <h5 class="h5-responsive">Order Note</h5>
            {{ $order->notes }}
        </x-box>
        @endif
    </div>
    {{-- End of col-md-8 --}}
    <div class="col-md-4">

        {{-- Customer Detail --}}
        <x-box class="rounded font-poppins mdb-color-text">
            <h6 class="h6-responsive mb-3">Customer Details</h6>
            <div class="text-muted">
                <table class="table table-sm b-light table-borderless table-hover">
                    <tr>
                        <td>
                            <i class="far fa-user"></i> 
                            <span class="ml-2">Name</span>
                        </td>
                        <td>
                            {{ $order->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="far fa-envelope"></i>
                            <span class="ml-2">Email</span>
                        </td>
                        <td>
                            {{ $order->user->email }}
                        </td>
                    </tr>
                    @if($order->user->mobile)
                    <tr>
                        <td>
                            <i class="fas fa-mobile-alt"></i>
                        </td>
                        <td>
                            {{ $order->user->mobile }}
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </x-box>

        <div class="my-3"></div>

        {{-- Shipping Details --}}
        <x-box class="rounded font-poppins mdb-color-text">
            <h6 class="h6-responsive mb-3">Shipping Details</h6>
            <div class="text-muted">
                <table class="table table-sm table-borderless table-hover">
                    <tr>
                        <td class="font-medium">Name</td>
                        <td>{{ $order->address->name }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">Email</td>
                        <td>{{ $order->address->email }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">Mobile</td>
                        <td>{{ $order->address->mobile }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">Address Line One</td>
                        <td>{{ $order->address->address_line_one }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">Address Line Two</td>
                        <td>{{ $order->address->address_line_two ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">City</td>
                        <td>{{ $order->address->city }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium">Region</td>
                        <td>{{ $order->address->region }}</td>
                    </tr>
                </table>
            </div>
        </x-box>
    </div>
    {{-- End of col-md-4 --}}
</div>
