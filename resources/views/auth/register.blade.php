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
            Already have account? <a class="text-purple-600 hover:underline focus:underline" href="{{ route('login') }}">Login</a>
        </div>

        @include('auth.register-form')

    </x-slot>
</x-auth-form>
@endsection
