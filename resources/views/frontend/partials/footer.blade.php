<style>
    #desktop-footer {
        background-color: #f7f7f7;
        color: #0f2a48;
    }

    #desktop-footer .heading {
        color: inherit;
        font-size: 1em;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 0.05em;
        margin-bottom: 5px;
    }

    #desktop-footer .heading-divider {
        display: block;
        margin-bottom: 12px;
        max-width: 100%;
        border-bottom: 1px dashed #696b70;
    }

    #desktop-footer .content {
        font-size: .9em;
        font-weight: 400;
        line-height: 1.6;
    }

</style>

<footer id="desktop-footer" class="hidden md:block py-6 md:py-10 font-sans">
    <div class="container mx-auto">
        <div class="flex flex-wrap -m-x-3">
            <div class="w-full md:w-3/12 px-3">
                <div class="content">
                    <p>
                        {{ settings()->get('about_us_short_text') }}
                    </p>
                    @if(settings()->get('about_us_page_slug') != null)
                    <div class="pt-3">
                        <a class="text-white py-2 px-2 md:px-4 my-3 bg-primary hover:bg-indigo-700 hover:shadow-lg focus:shadow-outline text-xs rounded-full" href="{{ route('frontend.pages.show', settings()->get('about_us_page_slug')) }}">Read More</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="w-full md:w-3/12 px-3">
                <div class="content">
                    <p>
                        <ul class="space-y-2">
                            <li><a class="hover:text-primary" href="{{ url('/') }}">Home</a></li>
                            <li><a class="hover:text-primary" href="#">About</a></li>
                            <li><a class="hover:text-primary" href="{{ route('frontend.contact-form.index') }}">Contact</a></li>
                            <li><a class="hover:text-primary" href="#">Privacy Policy</a></li>
                            <li><a class="hover:text-primary" href="#">Terms & conditions</a></li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="w-full md:w-3/12 px-3">
                {{-- <h1 class="heading font-lato">Get in Touch</h1> --}}
                {{-- <div class="heading-divider"></div> --}}
                <div class="content">
                    <p>
                        <ul>
                            <li>
                                <div class="opacity-75">Address:</div>
                                <address>SASA INTERNATIONAL, LLC NORTH CAROLINA, USA</a>
                            </li>
                            <li>
                                <div class="opacity-75">E-mail:</div>
                                <a href="mailto:merorojai@gmail.com">info@makaludogchew.com</a>
                            </li>
                            <li>
                                <div class="opacity-75">Phone:</div>
                                <a href="tel:+123456789">+123456789</a>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="w-full md:w-3/12 px-3">
                <h1 class="heading font-lato">We Accept</h1>
                {{-- <div class="heading-divider"></div> --}}
                <div class="content">
                    <p>
                        <ul class="flex items-center space-x-3 mt-4">
                            <li><a href="#"><img class="h-8" src="{{ asset('assets/img/paypal.png') }}" alt="" /></a></li>
                            {{-- <li><a href="#"><img class="h-8" src="{{ asset('assets/img/esewa.jpg') }}" alt="" /></a></li> --}}
                            <li><a href="#"><img class="h-8" src="{{ asset('assets/img/master-card.png') }}" alt="" /></a></li>
                            <li><a href="#"><img class="h-8" src="{{ asset('assets/img/visa-card.png') }}" alt="" /></a></li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

@if(settings('show_bottom_bar', 'yes') == 'yes')
<footer class="hidden md:block bg-theme-gray text-gray-800 font-roboto text-sm py-3">
    <div class="container mx-auto flex items-center">
        <div>
            <p>{!! settings('footer_left_text', 'Copyright © 2016 Makalu Dog Chew. All Rights Reserved.') !!}</p>
        </div>
        <div class="ml-auto">
            <p> {!! settings('footer_right_text') !!}</p>
        </div>
    </div>
</footer>
@endif

@mobile
{{-- Add space for mobile footer --}}
<div style="height: 50px;"></div>

{{-- Sidebar category list for mobile --}}
<aside id="sidebar-category" class="md:hidden fixed top-0 left-0 h-screen bg-white shadow-lg transition-all duration-500 z-20" style="width: 280px; margin-left: -280px">
    <x-sidebar-category-list></x-sidebar-category-list>
</aside>
<script>
    function openCategorySidebar() {
        document.getElementById('sidebar-category').style.marginLeft = "0";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeCategorySidebar() {
        document.getElementById('sidebar-category').style.marginLeft = "-280px";
        document.body.style.backgroundColor = "white";
    }

</script>

<footer id="mobile-footer" class="block md:hidden fixed bottom-0 w-screen bg-white border-t rounded-t-3xl">
    <ul class="flex items-center space-x-2 justify-between text-dark font-nunito font-semibold tracking-wide px-5 py-2">
        <li class="">
            <a class="" href="{{ route('home') }}">
                <span class="icon text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
                <span class="title mb-0 leading-none">Home</span>
            </a>
        </li>
        <li>
            <a href="#" role="button" onclick="openCategorySidebar()">
                <span class="icon text-dark text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </span>
                <span class="title mb-0 leading-none">Categories</span>
            </a>
        </li>
        <li>
            <a class="" href="{{ route('frontend.cart.index') }}">
                <span class="icon text-dark text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="title mb-0 leading-none">Cart</span>
            </a>
        </li>
        @auth
        <li>
            <a class="" href="{{ route('frontend.user.account.index') }}">
                <span class="icon text-dark text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="title mb-0 leading-none">Profile</span>
            </a>
        </li>
        @endauth
        @guest
        <li>
            <a class="" href="/login">
                <span class="icon text-dark text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="title mb-0 leading-none">Login</span>
            </a>
        </li>
        @endguest
    </ul>
</footer>
@endmobile
