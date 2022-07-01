<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @isset($title) {{ $title }} | @endisset {{ settings()->get('site_name', config('app.name'))}}
        @if(tagline()) - {{ tagline() }} @endif
    </title>

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    {!! SEO::generate() !!}

    <link rel="icon" href="{{ asset('storage/'. settings()->get('favicon')) }}" type="image/gif">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/drift/drift-basic.min.css') }}">

    <script src="{{ mix('js/app.js') }}"></script>

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

    @stack('styles')

    {{-- RECAPTCHA scripts --}}
    {!! htmlScriptTagJsApi() !!}

    {{-- Additional header scripts from settings --}}
    {!! settings('header_scripts') !!}

</head>
<body class="font-poppins pb-4 md:pb-0">

    @desktop
    @include('frontend.partials.topbar')
    @include('frontend.partials.header')
    @include('frontend.partials.navbar')
    @enddesktop

    @mobile
    @include('frontend.partials.mobile-header')
    @endmobile

    <script>
        window.onscroll = function() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.getElementById("sticky-header").classList.add('sticked');
                // document.getElementById("brand-logo").classList.add('scale-75');
                document.getElementById("sticky-header").classList.add('shadow-md');
            } else {
                document.getElementById("sticky-header").classList.remove('sticked');
                // document.getElementById("brand-logo").classList.remove('scale-75');
                document.getElementById("sticky-header").classList.remove('shadow-md');
            }
        };

    </script>

    @yield('breadcrumbs')

    @yield('content')

    @include('frontend.partials.footer')

    <!--scroll-top-start-->
    {{-- <div class="scroll-top-wrapper"> <span class="scroll-top-inner"> <i class="fa fa-2x fa-chevron-up"></i> </span> </div> --}}
    <!--scroll-top-end-->

    {{-- Try to load jquery and popper from laravel mix --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>

    <script src="{{ asset('assets/swiper/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>

    @include('alerts.snackbar')

    {{-- Drift only required in single product page --}}
    <script src="{{ asset('assets/drift/drift.min.js') }}"></script>

    @livewireScripts

    <script>
        window.livewire.on('toast', data => {
            const type = data[0];
            const message = data[1];

            showAlert(type, message);
        });

    </script>

    {{-- Finally stack the scripts --}}
    @stack('scripts')

    {{-- Facebook chat plugin from settings --}}
    {!! settings('facebook_chat_plugin') !!}

    {{-- Additional footer scripts from settings --}}
    {!! settings('footer_scripts') !!}
</body>
</html>
