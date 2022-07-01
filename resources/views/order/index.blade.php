@extends('layouts.admin')

@section('content')
<div>
    <x-section-title>Orders</x-section-title>

    <x-box class="rounded mb-4">
        <form action="" class="form-inline">
            <div class="form-row align-items-center">
                <div class="col-auto form-group">
                    <input type="text" name="order_id" class="form-control" value="{{ request()->order_id ?? null }}" placeholder="Order Number">
                </div>
                <div class="col-auto form-group ">
                    <select name="status" id="" class="custom-select">
                        <option value="all">All</option>
                        @foreach (config('constants.order.status') as $key => $value)
                        <option value="{{ $key }}" @if(request()->status == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </x-box>

    <x-box class="rounded">
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
                        <a class="btn btn-primary btn-sm z-depth-0" href="{{ route('backend.orders.show', $order) }}?update=true"><span class="mr-2"><i class="far fa-edit"></i></span>View</a>
                        {{-- <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-baseline">
                                @include('svg.verticle-dots')
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('backend.orders.show', $order) }}?update=true"><span class="mr-2"><i class="far fa-edit"></i></span>Update Order</a>
                        </div> --}}
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

        {{-- Pagination --}}
        @if ($orders->hasPages())
        <div class="d-md-flex justify-content-between">
            <div class="text-muted">
                Showing records {{ $orders->firstItem() }} - {{ $orders->lastItem() }} of {{ $orders->total() }}
            </div>
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
        @endif

    </x-box>
</div>
@endsection
