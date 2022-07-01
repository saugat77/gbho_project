@extends('layouts.app')

@section('content')
<x-frontend.account-layout>
    <x-slot name="mobileHeading">
        <x-frontend.partials.account-navigator :heading="$heading" />
    </x-slot>

    <x-slot name="heading">
        <h4 class="text-xl text-gray-800 leading-relaxed tracking-wide font-medium mb-3 font-poppins">{{ $heading }}</h4>
    </x-slot>

    <div class="bg-white rounded p-4 md:p-6">
        @include('partials.alerts')
        <livewire:user-profile :user='auth()->user()'>
    </div>
</x-frontend.account-layout>
@endsection
