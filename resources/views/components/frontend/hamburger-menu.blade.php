<div x-show="openSidebar" class="lg:hidden fixed top-0 left-0 h-screen max-w-md w-64 bg-white text-dark z-50 shadow-md transition" @click.away="openSidebar = false" x-cloak>
    <div class="flex flex-col h-full">
        <div class="bg-primary text-white p-4">
            <div class="flex flex-col items-center space-y-2 w-full">
                @auth
                <img class=" rounded-full h-10 w-10 mr-1" src="{{ auth()->user()->gravatar }}" alt="{{ Auth::user()->full_name }}">
                <div class="text-lg font-semibold leading-7">{{ auth()->user()->name }}</div>
                @else
                <svg class="rounded-full h-10 w-10 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                <div class="text-lg font-semibold leading-7">Hello Guest</div>
                @endauth
            </div>
        </div>

        <div class="flex-grow">
            <ul class="text-base font-semibold p-2">
                @hasanyrole('admin|seller')
                <li>
                    <a class="py-3 px-3 flex items-center space-x-2 hover:bg-gray-100" href="{{ route('backend.dashboard') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endhasanyrole
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="/">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.cart.index') }}">
                        <span class="opacity-75">
                           <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span>My Cart</span>
                    </a>
                </li>
                @auth
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.orders.index') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        <span>My Orders</span>
                    </a>
                </li>
                @endauth
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.wishlists.index') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        <span>My Wishlist</span>
                    </a>
                </li>
                @auth
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.my-reviews') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </span>
                        <span>My Reviews</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.user.account.index') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center space-x-2 py-3 px-3 hover:bg-gray-100" href="{{ route('frontend.password.index') }}">
                        <span class="opacity-75">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <div class="border-b border-indigo-100 rounded-full"></div>
                </li>
                <li>
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" value="9YPmgcObYq2F8VzdIxytf5dZg1pw20Vs28AVIwkw">
                        <button type="submit" class="flex w-full items-center space-x-2 py-3 px-3 hover:bg-gray-100">
                            <span class="opacity-75">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
        @guest
        <div class="p-3">
            <div class="grid grid-cols-2 gap-3">
                <a class="block py-2 px-3 text-center text-sm font-semibold border border-dark rounded tracking-wide" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="block py-2 px-3 text-center text-sm font-semibold border border-dark rounded tracking-wide" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </div>
        @endguest
    </div>
</div>