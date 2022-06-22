<link rel="icon" href="{{ asset('storage/'. settings()->get('favicon')) }}" type="image/gif">
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
<link href="{{ asset('assets/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/adminlte/css/adminlte.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/tagsinput/tagsinput.css') }}" rel="stylesheet">
<link href="{{ asset('assets/snackbar/snackbar.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dropzone/dist/dropzone.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@livewireStyles
@stack('styles')
<style>
    [x-cloak] {
        display: none;
    }

    .bg-theme-color {
        background-color: #6200EE;
    }

    .text-theme-color {
        color: #6200EE;
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }


    .font-hairline {
        font-weight: 100 !important;
    }

    .font-thin {
        font-weight: 200 !important;
    }

    .font-light {
        font-weight: 300 !important;
    }

    .font-normal {
        font-weight: 400 !important;
    }

    .font-medium {
        font-weight: 500 !important;
    }

    .font-semibold {
        font-weight: 600 !important;
    }

    .font-bold {
        font-weight: 700;
    }

    .font-extrabold {
        font-weight: 800;
    }

    .font-black {
        font-weight: 900;
    }

</style>
