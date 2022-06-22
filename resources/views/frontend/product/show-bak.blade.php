@extends('layouts.app')
@push('styles')
<style>
    @media only screen and (min-width: 600px) {
        .magnify-detail::before {
            display: none;
        }
    }

    /* #product__full_image {
        width: 100%;
        height: 400px;
    } */

</style>
@endpush

@section('breadcrumbs')
{{ Breadcrumbs::render('single-product', $product) }}
@endsection

@section('content')
<div class="bg-theme-gray py-4">
    <div class="container mx-auto px-3 md:px-0">
        <div class="bg-white">
            <div class="p-3">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-5/12 p-2">
                        <img id="product__full__image" class="magnify w-auto h-56 md:w-auto md:h-72 lg:h-96 object-cover mx-auto" src="{{ $product->featured_image_url }}" alt="{{ $product->name }}" data-zoom="{{ $product->featured_image_url }}">
                        <div class="swiper-container product__image__roll rounded-sm py-2 w-full bg-gray-100 px-2 shadow-xs">
                            {{-- <div class="swiper-pagination"></div> --}}
                            <div class="swiper-wrapper">
                                <img class="swiper-slide h-10 md:h-12 w-auto border border-transparent opacity-75 hover:border-theme-red hover:opacity-100 transform -translate-y-1 cursor-pointer" src="{{ $product->medium_featured_image_url }}">
                                @foreach ($product->productImages as $image)
                                <img class="swiper-slide h-10 md:h-12 w-auto border border-transparent opacity-75 hover:border-theme-red hover:opacity-100 cursor-pointer" src="{{ $image->medium_thumbnail_url }}">
                                @endforeach
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    <div class="w-full md:w-7/12 p-2 font-nunito ">
                        <div class="relative magnify-detail">
                            <h1 class="text-lg text-gray-900 font-semibold font-lato mb-4">{{ $product->name }}</h1>
                            @hasanyrole('admin|seller')
                            <a class="text-blue-600 hover:underline" href="{{ route('products.edit', $product) }}">Edit</a>
                            @endhasanyrole
                            <div class="pt-3 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-800 mr-2 mb-2">#
                                    {{ $product->category->name }}</span>
                            </div>
                            {{-- Ratings --}}
                            <div class="flex items-center space-x-2">
                                <div class="my-1">
                                    <x-rating-stars :stars="count($product->ratings)" />
                                </div>
                                @if(Auth::check() && Auth::user()->hasPurchased($product))
                                <div x-data="{ open: false }" @open-review-modal.window="open = true" @close-review-modal.window="open = false">
                                    <button type="button" class="text-sm text-blue-600 hover:underline" @click="$dispatch('open-review-modal')">Write a review</button>
                                    {{-- Review Modal --}}
                                    <div x-show="open" class="mt-6" x-cloak>
                                        <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full  z-50" style="background-color: rgba(0,0,0,.5);">
                                            <div class="w-full max-w-screen-sm p-3 md:p-6">
                                                <div class="bg-white rounded shadow mx-0 md:mx-10" @click.away="open = false">
                                                    <livewire:product-review :product="$product" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="flex items-center space-x-2">
                                @if($product->hasDiscount())
                                <h3 class="text-lg font-normal text-gray-700 line-through">{{ priceUnit() }}
                                    {{ number_format($product->regular_price) }}</h3>
                                @endif
                                <h1 class="text-2xl font-semibold text-theme-red">
                                    {{ priceUnit() }}
                                    {{ number_format($product->hasDiscount() ? $product->sale_price : $product->regular_price) }}
                                </h1>
                                @if($product->hasDiscount())
                                <span class="text-sm text-gray-700">({{ $product->discountPercentage() }} off)</span>
                                @endif
                            </div>
                        </div>
                        {{-- End of magnify-detail --}}

                        @if($product->sku)
                        <div class="text-sm text-gray-800 mb-3">SKU: {{ $product->sku }}</div>
                        @endif

                        @if($product->purchase_note)
                        <div class="bg-green-200 text-green-800 text-sm p-3 border-t border-b border-green-500">
                            {{ $product->purchase_note }}
                        </div>
                        @endif

                        <div class="flex space-x-3">
                            <livewire:add-to-cart-button :product="$product" withQuantity="true" />
                            <livewire:add-to-cart-button :product="$product" buyNow="true" />
                        </div>

                        @if($product->hasLimitedStock())
                        <div class="text-red-600 leading-8">
                            @if($product->stock_quantity && $product->stock_quantity <= limitedStockThreshold()) <div>
                                Only {{ $product->stock_quantity }} in stock
                        </div>
                        @else
                        <div class="flex items-center space-x-1 text-theme-red text-xs font-semibold">
                            <span class="text-yellow-600">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <span>Low on stock</span>
                        </div>
                        @endif
                    </div>
                    @endif
                    <livewire:wishlist-button :product="$product" />
                </div>
            </div>
        </div>
    </div>

    <div class="my-4"></div>

    {{-- Product details card --}}
    <div class="flex flex-col break-words bg-white shadow-xs">
        <div class="bg-theme-red text-gray-100 text-lg p-4 font-nunito">Product Details</div>
        <div class="p-4">
            <div class="flex flex-col divide-y">

                @if($product->product_highlights)
                <div class="py-3">
                    <ul class="list-inside list-disc grid grid-cols-2">
                        @foreach(explode(',', $product->product_highlights) as $highlight)
                        <li>{{ $highlight }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($product->product_weight || $product->product_length || $product->product_width || $product->product_height)
                <div class="text-sm font-nunito py-3">
                    @if($product->product_weight)
                    <div>Product Weight: {{ $product->product_weight }} </div>
                    @endif
                    @if($product->product_length || $product->product_width || $product->product_height)
                    <div>Dimension: {{ $product->product_length }} x {{ $product->product_width }} x {{ $product->product_height }} </div>
                    @endif
                </div>
                @endif

                <div class="py-3 font-roboto">
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>

            </div>
        </div>
    </div>
    {{-- End of Product details card --}}

    <div class="my-4"></div>

    {{-- Ratings and Reviews --}}
    <livewire:ratings-and-reviews-box :product='$product' />
    {{-- End of Ratings and Reviews --}}
</div>

<x-product-suggestion-grid title="Related Products" :products="$relatedProducts" />

<x-product-suggestion-grid title="Products by same seller" :products="$sameSellerProducts" />
</div>
@endsection

@push('scripts')
<script>
    $('.product__image__roll img').click(function() {
        console.log($(this).attr('src'));
        $('#product__full__image').attr('src', $(this).attr('src'));
        $('#product__full__image').attr('data-zoom', $(this).attr('src'));
    });


    new Swiper('.product__image__roll', {
        slidesPerView: 'auto'
        , speed: 400
        , spaceBetween: 10
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
        , pagination: {
            el: '.swiper-pagination'
            , type: 'progressbar'
        , }

    , });


    const driftOptions = {
        paneContainer: document.querySelector('.magnify-detail')
        , zoomFactor: 3
        , inlinePane: 700
        , inlineOffsetX: 100
        , inlineOffsetY: 0
        , handleTouch: false
        , hoverBoundingBox: true
    };

    const handleChange = () => {
        requestAnimationFrame(() => {
            if ($(window).width() <= 600 && !!window.productZoom) {
                window.productZoom.destroy();
            } else {
                window.productZoom = new Drift(document.querySelector('.magnify'), driftOptions);
            }
        })
    }

    window.addEventListener('resize', handleChange);
    window.addEventListener('load', handleChange);

</script>
@endpush
