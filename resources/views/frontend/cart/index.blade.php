@extends('layouts.app')

{{-- @section('breadcrumbs', Breadcrumbs::render('page', 'Cart')) --}}

@section('content')
<div class="sm:container mx-auto sm:my-5">
    <livewire:cart-details>
</div>
@endsection
