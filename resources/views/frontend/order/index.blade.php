{{-- @extends('frontend.account') --}}
@extends('layouts.app')

{{-- @section('heading') --}}
{{-- @endsection --}}

@section('content')
<x-frontend.account-layout>
    <x-slot name="mobileHeading">
        <x-frontend.partials.account-navigator :heading="$heading"/>
    </x-slot>

    <x-slot name="heading">
        <h4 class="text-xl text-gray-800 leading-relaxed tracking-wide font-medium mb-3 font-poppins">{{ $heading }}</h4>
    </x-slot>

    @include('alerts.tailwind.all')
    <div class="my-3"></div>
    <livewire:my-orders />

</x-frontend.account-layout>
@endsection
