@extends('layouts.app')

@section('content')
<div style="background-color: #f5f5f5;">
    <div class="block">
        <x-primary-image-slider />
    </div>

    <div class="my-5"></div>

    <div class="container py-">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg">Top Products</h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white">Top Products</h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}">View All</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-4">
                @foreach ($topProducts as $product)
                <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    </div>

    <div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg">New Arrivals</h2>
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.index') }}">View All</a>
            </div>
            <div class="bg-white  p-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-4">
                @foreach ($latestProducts as $product)
                <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    </div>


    <div class="bg-gray-100">
        <div class="container py-5 md:py-8 ">
            <div class="text-center mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-2xl tracking-wide">Blogs</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-8">
                @foreach ($posts as $post)
                <div class="bg-white rounded shadow-sm overflow-hidden">
                    @if ($post->cover_image)
                    <a href="{{ route('frontend.blogs.show', $post) }}" class="block aspect-w-12 aspect-h-6">
                        <img src="{{ $post->imageUrl() }}" alt=" {{ $post->title }}">
                    </a>
                    @endif
                    <div class="p-4">
                        <h6 class="text-gray-800 line-clamp-1">
                            <a href="{{ route('frontend.blogs.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h6>
                        <p class="text-sm">
                            {{ $post->excerpt }}
                        </p>
                        <a href="{{ route('frontend.blogs.show', $post) }}" class="underline text-sm font-semibold mt-4">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5 sm:mt-6">
                <a href="{{ route('frontend.blogs.index') }}" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-full hover:bg-blue-500 font-semibold text-sm">View All Blogs</a>
            </div>
        </div>
    </div>

    <div class="text-white py-5" style="background-color: #444444;">
        @include('frontend.partials.our-services')
    </div>

</div>
@endsection
