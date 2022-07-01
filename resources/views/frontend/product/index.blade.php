@extends('layouts.app')

@section('breadcrumbs')
@if($filter->has('category'))
{{ Breadcrumbs::render('products-category', $filter['category']) }}
@else
{{ Breadcrumbs::render('products') }}
@endif
@endsection

@push('styles')
<style>
    @media only screen and (max-width: 768px) {
        #product-filter {
            position: fixed;
            top: 0;
            bottom: 0;
            height: 1vh;
            overflow-x: hidden;
            transition: .5s;
            width: 250px;
            z-index: 100;
        }

        #product-filter.opened {
            margin-left: 0;
        }

        #product-filter.closed {
            margin-left: -260px;
        }

    }

</style>
@endpush

@section('content')
<div>
    <div class="container mx-auto pt-0 md:py-5">
        <div class="flex flex-wrap -mx-3">
            {{-- Left side Filter panel --}}
            <div class="w-full md:w-1/5 md:px-3">
                {{-- on mobile push it to sidebar --}}
                <div id="product-filter" class="font-sans bg-white py-4 px-3 min-h-screen shadow-sm closed">
                    @if(isset($relatedCategories) && count($relatedCategories))
                    <div class="filter-section">
                        <div class="filter-title">Related Categories</div>
                        <ul class="related-categories-list">
                            @foreach($relatedCategories as $category)
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug]) }}">
                                    {{ ucfirst($category->name) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="filter-section">
                        <div class="filter-title">Price</div>
                        <form id="price-filter" action="" class="price-filter">
                            <input type="number" name="min_price" class="form-input rounded-none w-full py-1 my-2" placeholder="min" value="{{ request()->get('min_price') }}">
                            <input type="number" name="max_price" class="form-input rounded-none w-full py-1 mt-2" placeholder="max" value="{{ request()->get('max_price') }}">
                            <button class="block w-full bg-white border border-dark text-dark hover:bg-dark hover:text-white hover:shadow py-2 px-3 text-sm font-semibold mt-3">
                                <div class="flex items-center justify-center space-x-2">
                                    {{-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                    </svg> --}}
                                    <svg class="w-4 h-4" fill="currentColor" stroke="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    <span class="tracking-wider font-nunito">Filter by Price</span>
                                </div>
                            </button>
                        </form>
                    </div>

                    <div class="filter-section">
                        <div class="filter-title">Rating</div>
                        <x-filter-rate :minVal="5" />
                        <x-filter-rate :minVal="4" />
                        <x-filter-rate :minVal="3" />
                        <x-filter-rate :minVal="2" />
                        <x-filter-rate :minVal="1" />
                    </div>

                </div>
            </div>

            {{-- Right Side --}}
            <div class="w-full md:w-4/5 px-3">
                {{-- Bar --}}
                <div class="block bg-white text-sm font-light py-2 px-4 -mx-4 md:mx-0">
                    <div class="flex items-center">
                        @if(request()->has('pname'))
                        <div class="hidden md:inline-flex text-gray-600 text-sm font-nunito">
                            {{ $products->count() }} items found for "{{ request()->input('pname') }}"
                        </div>
                        @endif
                        {{-- Show filter --}}
                        {{-- Filter Button opener for mobile --}}
                        <div x-data="" class="md:hidden">
                            <button id="filter-overlay" x-on:click="closeFilterPanel()" class="hidden fixed top-0 left-0 w-full h-full bg-black opacity-25 cursor-default"></button>
                            <button x-on:click="openFilterPanel()" class="flex items-center space-x-2 p-1 px-2 hover:bg-gray-400 rounded" type="button">
                                <span class="text-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                </span>
                                <span>Filter</span>
                            </button>
                        </div>
                        {{-- Sort By --}}
                        <div class="ml-auto">
                            <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                <span class="hidden md:inline-block text-gray-700 font-semibold mr-1">Sort By:</span>
                                <button @click="open = !open" class="inline-flex py-1 px-3 border border-gray-500 hover:shadow-sm">
                                    <span>Best Match</span>
                                    <span class="text-gray-600">
                                        <svg class="inline w-4 h-4 ml-1 transition-transform duration-200 transform" :class="{'rotate-180': open, 'rotate-0': !open}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </button>
                                <div x-show="open" class="absolute right-0 bg-white border border-gray-400 p-2 z-10 text-xs" x-cloak>
                                    <div class="py-2 px-4 rounded hover:bg-primary hover:text-white cursor-pointer">Best Match</div>
                                    <div class="py-2 px-4 rounded hover:bg-primary hover:text-white cursor-pointer">Price Low to High</div>
                                    <div class="py-2 px-4 rounded hover:bg-primary hover:text-white cursor-pointer">Price High to Low</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-4"></div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 md:gap-6 lg:gap-8">
                    @foreach($products as $product)
                    <livewire:product-card :product="$product" />
                    @endforeach
                </div>

                @if(!count($products))
                <div class="bg-white py-5 sm:py-8 lg:py-16 px-3 text-center shadow-sm">
                    No Products Found!!
                </div>
                @endif

                {{-- Pagination --}}
                @if ($products->hasPages())
                <div class="py-4 mt-2">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#price-filter').submit(function(event) {
        event.preventDefault();
        let formData = $(this).serialize();
        let fullUrl = "{{ url()->current() . '?' . http_build_query( request()->except(['min_price', 'max_price']) ) }}";
        let formUrl = fullUrl + "&" + formData;
        window.location.href = formUrl;
    })

    // Toggleable Filter Panel
    function openFilterPanel() {
        document.getElementById('product-filter').classList.add('opened');
        document.getElementById('product-filter').classList.remove('closed');
        document.getElementById('filter-overlay').classList.remove('hidden');
    }

    function closeFilterPanel() {
        document.getElementById('product-filter').classList.add('closed');
        document.getElementById('product-filter').classList.remove('opened');
        document.getElementById('filter-overlay').classList.add('hidden');
    }

    // Currently events are not used to triger filter panel
    window.addEventListener('open-filter-panel', openFilterPanel());
    window.addEventListener('close-filter-panel', closeFilterPanel());

</script>
@endpush
