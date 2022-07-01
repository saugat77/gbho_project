<style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .category-dropdown-menu {
        z-index: 999;
    }

    .category-dropdown-menu[data-show] {
        display: block;
    }

    .nav-menu {
        display: flex;
    }


    .nav-menu .nav-item .nav-link {
        display: inline-block;
        padding: 14px 8px;
        /* color: #fff; */
        font-size: .8em;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.030em;
    }

    .nav-menu .nav-item:first-of-type .nav-link {
        margin-left: -10px;
        padding-left: 10px;
    }

    .nav-menu .nav-item:last-of-type .nav-link {
        margin-right: -10px;
        padding-right: 10px;
    }

    .nav-menu .nav-item .nav-link:hover {
        color: #b21a19;
        background-color: #f7f7f7;
    }

</style>
<nav class="hidden md:block bg-navbar-colo">
    <div class="container flex mx-auto font-lato">
        <ul class="nav-menu justify-between w-full">
            <li class="nav-item cursor-pointer">
                <div class="dropdown inline-block relative">
                    <span class="nav-link">
                        <span class="flex items-center">
                            <svg class="h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            
                        </span>
                    </span>
                    <div class="category-level-one-wrapper dropdown-menu absolute hidden pt-1 shadow" style="z-index: 999">
                        <x-multilevel-category-menu />
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.products.index') }}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.pages.show', 'about-us') }}">Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.contact-form.index') }}">Contact Us</a>
            </li>
        </ul>

        {{-- <ul class="ml-auto nav-menu flex-shrink-0">
            @guest

            @if(Route::currentRouteName() == 'login')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @else
            <li class="nav-item">
                <span x-data="{ open: false }" x-init="() => {
                    @if($errors->login->any())
                    open = true
                    @endif
                    }" @open-login-form.window="open = true" @hide-login-form.window="open = false">
                    <button class="nav-link" @click="open = true">Login</button>
                    @include('auth.login-modal')
                </span>
            </li>
            @endif
            
            @if(Route::currentRouteName() == 'register')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @else
            <li class="nav-item">
                <span x-data="{ open: false }" x-init="() => {
                    @if($errors->register->any())
                    open = true
                    @endif
                    }" @open-register-form.window="open = true" @hide-register-form.window="open = false">
                    <button class="nav-link" @click="open = true">Register</button>
                    @include('auth.register-modal')
                </span>
            </li>
            @endif

            @else
            <li class="nav-item">
                <div class="inline-block relative" x-data="{ open: false }">
                    <a class="nav-link" href="#" type="button" @click="open = true">
                        <span class="flex items-center">
                            <svg class="inline h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span> {{ auth()->user()->name}}</span>
                        </span>
                    </a>
                    <ul class="absolute bg-white shadow-xl rounded-lg w-40 py-2 text-gray-700 font-normal z-50" x-show="open" @click.away="open = false" x-cloak>
                        @hasanyrole('admin|seller')
                        <a class="py-2 px-3 block hover:bg-gray-200" href="{{ route('backend.dashboard') }}">Dashboard</a>
                        @endhasanyrole
                        <a class="py-2 px-3 block hover:bg-gray-200" href="{{ route('user.profile') }}">Profile</a>
                        <a class="py-2 px-3 block hover:bg-gray-200" href="{{ route('frontend.orders.index') }}">My orders</a>
                        <a class="py-2 px-3 block hover:bg-gray-200 border-b" href="{{ route('frontend.wishlists.index') }}">Wishlist</a>
                        <a class="py-2 px-3 block hover:bg-gray-200" href="#" type="button" onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();">Logout</a>
                        <form id="nav-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </li>
            @endguest
        </ul> --}}
    </div>
</nav>
