@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('discount-card'))

@section('content')
<div class="bg-blue-gray">
    <div class="container mx-auto py-5">
        <livewire:discount-card-form>
    </div>
</div>
@endsection
