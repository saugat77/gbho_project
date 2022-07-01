@extends('layouts.admin')

@section('content')
<div>
    <div class="d-flex">
        <h2 class="h2-responsive align-self-center">Order Details</h2>
        <div class="ml-auto">
            <button class="btn btn-success my-0 border font-poppins text-capitalize" data-toggle="modal" data-target="#orderPaymentStatusModal">Change Payment Status</button>
            <button class="btn btn-success my-0 border font-poppins text-capitalize" data-toggle="modal" data-target="#orderUpdateModal">Change Order Status</button>
        </div>
    </div>
    <livewire:update-order-payment :order="$order" />
    <livewire:order-update :order="$order" />

    <div class="my-4"></div>

    <livewire:order-detail :order="$order" />

    @if($order->paypal_response)
    <div class="bg-white p-3">
        {{ $order->paypal_response }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    Livewire.on('orderUpdated', function() {
        $('#orderUpdateModal').modal('hide');
    });

    Livewire.on('orderPaymentStatusUpdated', function() {
        $('#orderPaymentStatusModal').modal('hide');
    })

</script>
@endpush