@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{-- Stats --}}
        <div class="col-md-3">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fa fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Products</span>
                    <span class="info-box-number"><span class="font-weight-normal">Total:</span> {{ $productsCount }} ({{ $categoriesCount }} Categories)</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Customers</span>
                    <span class="info-box-number">Total {{ $customersCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Orders</span>
                    <span class="info-box-number">Total {{ $ordersCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-mail-bulk"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contact Messages</span>
                    <span class="info-box-number">Total {{ $ordersCount }}</span>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-3">
            <div class="info-box bg-pink">
                <span class="info-box-icon"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stores</span>
                    <span class="info-box-number">Total {{ $storesCount }}</span>
                </div>
            </div>
        </div> --}}

        <div class="col-md-6">
            <x-dashboard.tiles.earnings-chart-tile />
        </div>

        <div class="col-md-6">
            <x-dashboard.tiles.new-users-chart-tile />
        </div>

        <div class="col-md-12">
            <x-uncompleted-order-list />
        </div>
    </div>
</div>
@endsection

@push('styles')
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

@endpush
