<style>
    .sticked>#main-header {
        padding-top: 5px !important;
        padding-bottom: 10px !important;
    }

</style>
<div id="main-header" class="bg-white text-dark py-5 transition-all delay-250 duration-500">
    <header class="container mx-auto">
        <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <div class="mr-2">
                    <div class="flex items-center space-x-2 md:space-x-3 mr-2">
                        {{-- <a id="brand-logo" href="{{ route('home') }}" class="transform transtion duration-700 hidden md:block flex-shrink-0">
                        <img class="w-32 h-16" src="{{ siteLogoUrl() }}" alt="{{ config('app.name') }}" />
                        </a> --}}
                        <div class="flex-shrink-0">
                            {{-- <a class="text-xl md:text-2xl font-semibold tracking-wide font-roboto" href="/"><span class="">Makalu</span> <span class=" text-primary">Dairy</span></a> --}}
                            <a class="text-xl md:text-2xl font-semibold tracking-wide font-roboto" href="/">
<<<<<<< HEAD
                                <img src="/images/logo.png" alt="">
=======
                                <img src="/images/GBHO-logo.png" alt="">
                                <style>
                                    img{
                                        width: 100px;
                                        height: 100px;
                                    }
                                </style>
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:header-search />
            <div class="ml-auto flex items-center space-x-3 md:space-x-5">
                <a href="{{ route('frontend.wishlists.index') }}" class="hidden md:block hover:text-primary">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </a>
                <livewire:cart-summary />
            </div>
        </div>
    </header>
</div>
