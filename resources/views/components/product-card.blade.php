<div class="product__card flex flex-col bg-white shadow-sm hover:shadow">
    <div class="relative">
        <div class="product__image__wrapper overflow-hidden">
            <a href="{{ route('frontend.products.show', $product) }}" class="aspect-h-6 aspect-w-6 block">
                <img class="product__image w-full h-full hover-img rounded-t object-contain transform duration-300 hover:scale-105" src="{{ $product->small_featured_image_url }}" alt="{{ $product->title }}" loading="lazy" />
            </a>
            @if($product->hasDiscount())
            <div class="absolute top-0 right-0 pr-1 pt-1">
                <span class="bg-secondary rounded text-sm font-medium text-gray-900 py-1 px-2 font-sans">{{ $product->discountPercentage() }} off</span>
            </div>
            @endif
        </div>
    </div>
    <div class="grid h-full py-2 px-2">
        <div class="sm:mt-3">
            <h5 class="font-normal text-sm text-gray-900 text- leading-5 font-sans hover:text-indigo-700" style="display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;">
                <a href="{{ route('frontend.products.show', $product) }}">{{ ucfirst($product->name) }}</a>
            </h5>
        </div>
        <div class="self-end">
            <div class="flex items-center space-x-1 md:space-x-2 my-1 font-sans justify-">
                @if($product->hasDiscount())
                <div class="text-xs font-semibold text-gray-700 line-through">{{ priceUnit() }} {{ number_format($product->regular_price) }}</div>
                @endif
                <div class="texsm font-semibold text-theme-red"> {{ priceUnit() }} {{ number_format($product->hasDiscount() ? $product->sale_price : $product->regular_price) }}</div>
            </div>
        </div>
    </div>
</div>
