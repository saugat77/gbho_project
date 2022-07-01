<div class="flex ml-2 w-full" :class="{ 'hidden': mobileSearch }">
    <a href="{{ route('frontend.cart.index') }}" slot="icon" class="relative hover:text-primary mr-4">
        <div class="absolute top-0 right-0 -mt-1 -mr-4 px-2 text-xs rounded-full font-semibold bg-primary bg-opacity-75 text-white">{{ $cartCount }}</div>
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
    </a>
</div>