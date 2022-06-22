@extends('layouts.app')

@section('content')
<div class=" bg-gray-100 py-10 font-nunito">
    <main class="sm:container sm:mx-auto sm:max-w-lg px-3">
        <div class="flex">
            <div class="w-full">

                @if (session('resent'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100  px-3 py-4 mb-4" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif

                <section class="bg-white rounded-md shadow-sm p-3">
                    <header class="bg-theme-red text-white py-5 px-6 sm:py-6 sm:px-8 rounded-md">
                        {{ __('Verify Your Email Address') }}
                    </header>

                    <div class="text-gray-700 leading-normal text-sm p-6 space-y-4 sm:text-base sm:space-y-6">
                        <p>
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                        </p>

                        <p>
                            {{ __('If you did not receive the email') }}, <a class="text-indigo-600 hover:text-blue-700 no-underline hover:underline cursor-pointer" onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">{{ __('click here to request another') }}</a>.
                        </p>

                        <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}" class="hidden">
                            @csrf
                        </form>
                    </div>

                </section>
            </div>
        </div>
    </main>
</div>
@endsection
