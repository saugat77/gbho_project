@extends('layouts.app')

@section('content')
<x-frontend.account-layout>
    <x-slot name="mobileHeading">
        <x-frontend.partials.account-navigator :heading="$heading" />
    </x-slot>

    <x-slot name="heading">
        <h4 class="text-xl text-gray-800 leading-relaxed tracking-wide font-medium mb-3 font-poppins">{{ $heading }}</h4>
    </x-slot>

    <div>
        @foreach($wishlists as $wishlist)
        @continue(!$wishlist->product)
        <div class="bg-white rounded mb-4">
            <div class="p-3">
                <div class="flex justify-between text-gray-800">
                    <div class="flex gap-2">
                        <div class="py-2">
                            <img class="h-24 w-24 rounded" src="{{ $wishlist->product->featured_image_url }}">
                        </div>
                        <div class="px-4 py-2 font-nunito">
                            <div>
                                <a class="hover:underline" href="{{ route('frontend.products.show', $wishlist->product) }}">{{ ucfirst($wishlist->product->name) }}</a>
                            </div>
                            <div class="mt-2 flex gap-4">
                                <button type="submit" class="bg-blue-600 border  border-blue-600 text-white text-xs font-semibold py-2 px-3 hover:bg-transparent hover:text-blue-600 hover:shadow-lg rounded inline-flex items-center">
                                    <svg class="h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Add to cart</span>
                                </button>
                                <form action="{{ route('frontend.wishlists.destroy', $wishlist) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 border  border-red-500 text-white text-xs font-semibold py-2 px-3 hover:bg-transparent hover:text-red-500 hover:shadow-lg rounded inline-flex items-center">
                                        <svg class="h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Remove</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        <div class="text-lg">
                            {{ priceUnit() }} {{ number_format($wishlist->product->current_price) }}
                        </div>
                        @if ($wishlist->product->hasDiscount())
                        <div class="text-sm">
                            <span class="text-gray-600 line-through">
                                {{ priceUnit() }} {{ number_format($wishlist->product->regular_price) }}
                            </span>
                            <span class="ml-1"> (- {{ $wishlist->product->discountPercentage() }})</span>
                        </div>
                        <div class="text-green-500 text-xs">Price dropped</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if(!count($wishlists))
        <div class="w-full flex items-center">
            <div class="container flex flex-col items-center justify-center p-5 text-gray-700">
                <div>
                    <img class="h-32 md:h-48 w-auto" src="{{ asset('assets/img/no-search-results.png') }}" alt="{{ __('No Content') }}">
                </div>
                <div class="max-w-md text-center font-sans">
                    <h3 class="text-2xl md:text-3xl text-indigo-500 fontsemibold my-4 tracking-wide">
                        WOOPS! Nothing here
                    </h3>
                    <a href="{{ route('home') }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 shadow text-white bg-indigo-500 transition-colors duration-150 rounded focus:outline-none focus:shadow-outline-blue bg-theme-red active:bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 hover:shadow-lg focus:shadow-lg tracking-wide">Back to Homepage</a>
                </div>
            </div>
        </div>
        @endif
    </div>

</x-frontend.account-layout>
@endsection
