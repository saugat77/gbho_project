@extends('layouts.app')

@section('content')
<div class="bg-gray-200 p-10 font-nunito">
    <div class="container mx-auto">
        <div class="bg-white p-4 max-w-sm mx-auto shadow-xs">
            <div class="text-2xl font-bold tracking-wider mb-3">{{ __('Reset Password') }}</div>

            @if (session('status'))
            <p class="bg-green-200 py-2 px-3 text-green-800 text-sm border border-green-500 rounded my-3">
                {{ session('status') }}
            </p>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-input w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-3">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-wrap items-center">
                    <button type="submit" class="bg-theme-red hover:bg-red-700 text-gray-100 font-semibold py-2 px-5 rounded-sm focus:outline-none focus:shadow-outline">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
