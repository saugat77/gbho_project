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
<div class="container mx-auto">
    <div class="bg-white my-5">
        <div class="grid grid-cols-12 gap-4 lg:gap-5 xl:gap-8">
            <div class="col-span-12 sm:col-span-4">
                {{-- Product Images --}}
                <div class="swiper-container product__image__roll rounded-sm py-2 w-full bg-gray-100 px-2 shadow-xs">
                    <div class="swiper-wrapper">
                        <img class="swiper-slide w-auto h-56 md:w-auto md:h-72 lg:h-96 object-cover mx-auto" src="{{ $product->medium_featured_image_url }}">
                        @foreach ($product->productImages as $image)
                        <img class="swiper-slide w-auto h-56 md:w-auto md:h-72 lg:h-96 object-cover mx-auto" src="{{ $image->medium_thumbnail_url }}">
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                {{-- Thumbs --}}
                <div class="swiper-container product__image__thumbs rounded-sm py-2 w-full bg-gray-100 px-2 shadow-xs hidden">
                    <div class="swiper-wrapper">
                        <img class="swiper-slide h-10 md:h-12 w-auto" src="{{ $product->medium_featured_image_url }}">
                        @foreach ($product->productImages as $image)
                        <img class="swiper-slide h-10 md:h-12 w-auto" src="{{ $image->medium_thumbnail_url }}">
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                {{-- End of product images --}}
            </div>
            <div class="col-span-12 sm:col-span-8 font-nunito">
                @mobile
                <div class="flex bg-main-600 p-3 rounded text-white">
                    <div>
                        <h1 class="text-2xl font-semibold text-white">
                            {{ priceUnit() }}
                            {{ number_format($product->hasDiscount() ? $product->sale_price : $product->regular_price) }}
                        </h1>
                        <div class="flex items-center space-x-2">
                            @if($product->hasDiscount())
                            <h3 class="text-lg font-normal text-gray-100 line-through">{{ priceUnit() }}
                                {{ number_format($product->regular_price) }}</h3>
                            @endif
                            @if($product->hasDiscount())
                            <span class="text-sm text-white">({{ $product->discountPercentage() }} off)</span>
                            @endif
                        </div>
                    </div>
                    <div class="ml-auto">
                        @include('frontend.product.__ratings_rate')
                    </div>
                </div>
                @endmobile

                <h1 class="text-lg text-gray-900 font-semibold font-lato mb-3 mt-3 sm:mt-0">{{ $product->name }}</h1>

                @hasanyrole('admin|seller')
                <a class="text-blue-600 hover:underline" href="{{ route('products.edit', $product) }}">Edit</a>
                @endhasanyrole

                @desktop
                <div class="pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-800 mr-2 mb-2">#
                        {{ $product->category->name }}</span>
                </div>
                {{-- Ratings & Rate --}}
                @include('frontend.product.__ratings_rate')
                <div class="flex items-center space-x-2">
                    @if($product->hasDiscount())
                    <h3 class="text-lg font-normal text-gray-700 line-through">{{ priceUnit() }}
                        {{ number_format($product->regular_price) }}</h3>
                    @endif
                    <h1 class="text-2xl font-semibold text-primary">
                        {{ priceUnit() }}
                        {{ number_format($product->hasDiscount() ? $product->sale_price : $product->regular_price) }}
                    </h1>
                    @if($product->hasDiscount())
                    <span class="text-sm text-gray-700">({{ $product->discountPercentage() }} off)</span>
                    @endif
                </div>
                @enddesktop

                @if($product->sku)
                <div class="text-sm text-gray-800 mb-3">SKU: {{ $product->sku }}</div>
                @endif

                @if($product->purchase_note)
                <div class="bg-green-200 text-green-800 text-sm p-3 border-t border-b border-green-500">
                    {{ $product->purchase_note }}
                </div>
                @endif

                <div class="flex space-x-3">
                    <livewire:add-to-cart-button :product="$product" :withQuantity="is_desktop() ? true : false" />
                    <livewire:add-to-cart-button :product="$product" buyNow="true" />
                </div>

                @if($product->hasLimitedStock())
                <div class="text-secondary leading-8">
                    @if($product->stock_quantity && $product->stock_quantity <= limitedStockThreshold()) <span>Only {{ $product->stock_quantity }} in stock </span>
                        @else
                        <div class="flex items-center space-x-1 text-primary text-xs font-semibold">
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

    <div class="my-4"></div>

    {{-- Product details card --}}
    <div class="break-words">
        {{-- <h4 class="text-primary text-lg py-2 px-4 font-semibold">Product Details</h4> --}}
        <div class="px-2 sm:px-4">
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

    <x-product-suggestion-grid title="Similar Products" :products="$relatedProducts" />
</div>
@endsection

@push('scripts')
<script>
    var galleryThumbs = new Swiper('.product__image__thumbs', {
        spaceBetween: 10
        , slidesPerView: "auto"
        , freeMode: true
        , loopedSlides: 5, //looped slides should be the same
        watchSlidesVisibility: true
        , watchSlidesProgress: true
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
    });

    new Swiper('.product__image__roll', {
        spaceBetween: 10
        , loop: true
        , loopedSlides: 5, //looped slides should be the same
        navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
        , thumbs: {
            swiper: galleryThumbs
        , }
    });

</script>


<script>
    window.addEventListener('load', (event) => {
        let url = new URL(window.location.href);
        if (url.searchParams.get('rate-now')) {
            console.log('Opening review modal');
            window.dispatchEvent(new Event('open-review-modal'));
        }
    });

</script>
@endpush
