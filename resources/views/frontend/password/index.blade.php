@extends('layouts.app')

@section('content')
<x-frontend.account-layout>
    <x-slot name="mobileHeading">
        <x-frontend.partials.account-navigator :heading="$heading" />
    </x-slot>

    <x-slot name="heading">
        <h4 class="text-xl text-gray-800 leading-relaxed tracking-wide font-medium mb-3 font-poppins">{{ $heading }}</h4>
    </x-slot>
    
    <div class="bg-white rounded p-4">
        @if(session()->has('passwordSuccess'))
        <div wire:click="$set('profileUpdated', false)" class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 mb-3 shadow cursor-pointer" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" /></svg></div>
                <div>
                    <p class="font-semibold">{{ session()->get('passwordSuccess') }}</p>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('frontend.password.update') }}" method="POST">
            @csrf
            @method('patch')

            @if(!empty($user->password))
            <div class="mb-3">
                <label class="block text-gray-700 font-medium mb-2">Old password</label>
                <input type="password" name="old_password" class="form-input w-full @error('old_password')  border-red-500 @enderror">
                <x-tailwind-invalid-feedback field="old_password" />
            </div>
            @endif

            <div class="mb-3">
                <label class="block text-gray-700 font-medium mb-2">New password</label>
                <input type="password" name="password" class="form-input w-full @error('password')  border-red-500 @enderror">
                <x-tailwind-invalid-feedback field="password" />
            </div>

            <div class="mb-3">
                <label class="block text-gray-700 font-medium mb-2">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-input w-full @error('password_confirmation')  border-red-500 @enderror">
                <x-tailwind-invalid-feedback field="password_confirmation" />
            </div>

            <div class="pt-3">
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-full font-nunito text-lg">Change now</button>
            </div>
    </div>
</x-frontend.account-layout>
@endsection