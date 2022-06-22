<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @isset($title) {{ $title }} | @endisset {{ settings()->get('site_name', config('app.name'))}}
        @if(settings('tagline')) - {{ settings('tagline') }} @endif
    </title>

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    @include('layouts.partials.admin.styles')

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
    
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('layouts.partials.admin.navbar')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-0 sidebar-light-indigo">
            @include('layouts.partials.admin.sidebar')
        </aside>

        <div class="content-wrapper p-4">
            @yield('content')
        </div>

        @include('layouts.partials.admin.footer')

    </div>
    <!-- End of site wrapper -->

    @include('layouts.partials.admin.scripts')
    {{-- Make sure snackbar id after /public/assets/js/scripts.js file --}}
    @include('alerts.snackbar')

    <script>
        window.livewire.on('toast', data => {
            const type = data[0];
            const message = data[1];

            showAlert(type, message);
        });
    </script>

</body>
</html>
