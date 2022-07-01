@if(settings
('show_top_bar', 'yes') == 'yes')

<style>
    .donate-btn{
        background-color: #FF4949;
        color: #fff;
        padding: 5px ;
        border-radius: 5px;
    }

    .donate-btn:hover{
        background-color: #F55353;
        color: #fff;
        transition: 0.5s;
    }
</style>
<header class="hidden md:block border-b z-20" style="color: #444444; font-family: 'Open Sans', sans-serif;">
    <div class="container mx-auto text-sm font-sans py-2">
        <div class="flex justify-between">
            <ul class="flex items-center space-x-3 tracking-wider">
                {{-- @if(settings('topbar_mobile')) --}}
                <li>
                    <svg class="h-4 inline mr-1 text-primary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M14.414 7l3.293-3.293a1 1 0 00-1.414-1.414L13 5.586V4a1 1 0 10-2 0v4.003a.996.996 0 00.617.921A.997.997 0 0012 9h4a1 1 0 100-2h-1.586z"></path><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    <span>{{ settings('topbar_mobile', '123456789') }}</span>
                </li>
                {{-- @endif --}}
                {{-- @if(settings('topbar_email')) --}}
                <li>
                    <svg class="h-4 inline mr-1 text-primary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    <span>{{ settings('topbar_email', 'info@makaludogchew.com') }}</span>
                </li>
                {{-- @endif --}}
            </ul>

            <div classs="ml-auto">
                <ul class="flex items-center space-x-3">
                    @guest
                    @if(Route::currentRouteName() == 'register')
                    <li>
                        <a class="hover:underline" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li>
                        <span x-data="{ open: false }" x-init="() => { @if($errors->register->any()) open = true @endif }" @open-register-form.window="open = true" @hide-register-form.window="open = false">
                            <button class="hover:underline" @click="open = true">Register</button>
                            @include('auth.register-modal')
                        </span>
                    </li>
                    @endif
                    @if(Route::currentRouteName() == 'login')
                    <li>
                        <a class="hover:underline" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                    <li>
                        <span x-data="{ open: false }" x-init="() => { @if($errors->login->any()) open = true @endif }" @open-login-form.window="open = true" @hide-login-form.window="open = false">
                            <button class="hover:underline" @click="open = true">Login</button>
                            @include('auth.login-modal')
                        </span>
                    </li>
                    @endif
                    @endguest

                    <li>
                        <a class="hover:underline" href="/wishlists">My Wishlist</a>
                    </li>
                    <li>
                        <a class="hover:underline" href="/cart">My Cart</a>
                    </li>

                    <button class="donate-btn"> Donate Us</button>

                    @auth
                    <li>
                        <div class="inline-block relative" x-data="{ open: false }">
                            <button type="button" @click="open = true" class="inline-flex items-center space-x-1">
                                <span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg></span>
                                <span> {{ auth()->user()->name}}</span>
                                <span>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </span>
                            </button>
                            <ul class="absolute text-base bg-white w-48 md:w-56 lg:w-64 p-2 text-gray-800 font-normal z-50 right-0 mt-3 rounded-lg shadow-md border border-gray-200" x-show="open" @click.away="open = false" x-cloak>
                                <div class="py-2 px-3 block">
                                    <div>Signed in as</div>
                                    <div class="font-medium">{{ auth()->user()->email ?? auth()->user->mobile }}</div>
                                </div>
                                <div class="border-b border-gray-300 -mx-2 my-2"></div>
                                @hasanyrole('super-admin|admin')
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="{{ route('backend.dashboard') }}">Dashboard</a>
                                @endhasanyrole
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="{{ route('user.profile') }}">Profile</a>
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="{{ route('frontend.orders.index') }}">My orders</a>
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="{{ route('frontend.my-reviews') }}">My Reviews</a>
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="{{ route('frontend.wishlists.index') }}">Wishlist</a>
                                <div class="border-b border-gray-300 -mx-2 my-2"></div>
                                <a class="py-2 px-3 block hover:bg-main-400 hover:text-white rounded" href="#" type="button" onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();">Logout</a>
                                <form id="nav-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
@endif
