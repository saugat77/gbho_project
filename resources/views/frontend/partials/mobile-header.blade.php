<div id="main-header" class="bg-dark text-white py-3 transition-all delay-250 duration-500" x-data="{ searching: false, mobileSearch: false, openSidebar: false }" @click.away="searching = false">
    <x-frontend.hamburger-menu></x-frontend.hamburger-menu>

    <header class="flex items-center px-4">
        <div class="flex items-center space-x-2">
            <button :class="{ 'hidden': mobileSearch }" type="button" x-on:click="openSidebar = true">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="mr-2">
                <div class="flex items-center space-x-2 md:space-x-3 mr-2">
                    {{-- <a id="brand-logo" href="{{ route('home') }}" class="transform transtion duration-700 hidden md:block flex-shrink-0">
                    <img class="w-32 h-16" src="{{ siteLogoUrl() }}" alt="{{ config('app.name') }}" />
                    </a> --}}
                    <div class="flex-shrink-0">
                        <a class="text-xl md:text-2xl font-semibold tracking-wide font-roboto" href="/"><span class="">Makalu</span> <span class=" text-white">Dairy</span></a>
                        {{-- <a href="/"><img class="h-10" src="/images/logo.png" alt=""></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-auto flex items-center space-x-3 md:space-x-5">
            <a href="{{ route('frontend.wishlists.index') }}" class="hidden md:block hover:text-white">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>
            <livewire:cart-summary />
        </div>
    </header>

    @if(request()->is(['/', 'products']))
    <div class="px-4 mt-2">
        <form action="{{ route('frontend.products.index') }}" method="GET">
            @csrf
            <div class="flex w-full text-sm">
                <input wire:model="query" type="text" name="pname" class="w-full border-2 border-r-0 border-white font-nunito font-bold py-2 px-4 text-dark placeholder-dark tracking-wide rounded-l" placeholder="I'm looking for..." autocomplete="off">
                <button type="submit" class="block h-full bg-primary text-white py-3 px-3 hover:bg-primary border border-primary hover:border-primary rounded-r">
                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    @endif
</div>
