<div class="card rounded z-depth-0">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <div class="card-title">New/Uncompleted Orders</div>
            <div class="ml-auto">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool z-depth-0" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool z-depth-0" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
        </div>
        <table class="table table-responsive-sm">
            <thead>
                <tr class="text-uppercase font-poppins">
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Placed At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <a class="text-primary font-semibold" href="{{ route('backend.orders.show', $order) }}">#{{ $order->id }}</a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-circle" src="{{ $order->user->gravatar }}" style="height: 37px; height: 37px; padding: 2px; border: 1px solid #c2c3c4;">
                            <div class="ml-2">
                                {{ $order->user->name }}
                            </div>
                        </div>
                    </td>
                    <td>{{ priceUnit() }} {{ $order->billAmount() }}</td>
                    <td>
                        <span class="order-status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>
                        <span class="payment-status-badge {{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span>
                    </td>
                    <td>{{ $order->created_at->isoFormat('lll') }}</td>
                    <td class="text-right">
                        <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-baseline">
                                @include('svg.verticle-dots')
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('backend.orders.show', $order) }}?update=true"><span class="mr-2"><i class="far fa-edit"></i></span>Update Order</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="42" class="text-center">No orders found</td>
                </tr>
                @endforelse

            </tbody>
            <tfoot>

            </tfoot>
        </table>

        </-box>
