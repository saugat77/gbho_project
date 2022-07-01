@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-flex">
                    <h4>{{ $updateMode ? $product->name : 'New Product' }}</h4>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <a class="btn btn-outline-primary btn-sm z-depth-0 align-self-center my-0 ml-3 py-1 waves-effect waves-light" href="{{ route('products.create') }}">Add New</a>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid pb-5">
    @include('product.tab-head')
    @include('alerts.all')
    {{ $slot }}
</section>
@endsection
