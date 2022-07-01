<div class="text-black font-nunito flex flex-col overflow-hidden h-full" style="z-index: 100">
    <div class="flex font-semibold p-2 text-lg bg-white border flex-shrink-0">
        <span class="underline">Shop by Category</span>
        <button class="ml-auto" onclick="closeCategorySidebar()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <ul class="divide-y text-sm pb-10 overflow-y-scroll">
        <li class="pl-5">
            <div class="flex items-center py-2 pr-3 pl-2" @click="expanded = !expanded" :class="{ 'bg-gray-200': expanded }">
                <a href="{{ route('frontend.products.index') }}">{{ __('All Products') }}</a>
            </div>
        </li>
        @foreach ($categoryMenus as $category)
        <li x-data="{ expanded: false }" @click.away="expanded = false">
            <div class="flex items-center py-2 pr-3 pl-2" @click="expanded = !expanded" :class="{ 'bg-gray-200': expanded }">
                <span class="mr-2 text-gray-600">
                    <svg class="w-3 h-3 inline transition-transform duration-200 transform" :class="{'rotate-90': expanded, 'rotate-0': !expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
                <a href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name) }}</a>
                <button class="ml-auto">
                    <svg x-show="!expanded" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <svg x-show="expanded" x-cloak class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path>
                    </svg>
                </button>
            </div>
            @if(count($category->childcategories))
            <div class="ml-5 text-sm p-1" x-show="expanded" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                @foreach($category->childcategories as $category)
                <div class="font-semibold font-sans text-teal-700 mb-1">
                    <a class="block hover:bg-gray-100 focus:bg-gray-100" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name) }}</a>
                </div>
                <ul class="ml-4">
                    @foreach($category->childcategories as $category)
                    <li>
                        <a class="block hover:bg-gray-100 focus:bg-gray-100" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name) }}</a>
                    </li>
                    @endforeach
                </ul>
                @endforeach
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
