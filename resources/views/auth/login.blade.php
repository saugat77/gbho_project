@extends('layouts.app')

@section('content')
<x-auth-form>
    <x-slot name="left">
        <div class="h-full flex items-center">
            @include('frontend.svg.login')
        </div>
    </x-slot>
    
    
    <x-slot name="form">
        <div class="text-center md:text-right mb-4">
            New user? <a class="text-purple-600 hover:underline focus:underline" href="{{ route('register') }}">Register</a>
        </div>

        @include('auth.login-form')

    </x-slot>
</x-auth-form>
@endsection
