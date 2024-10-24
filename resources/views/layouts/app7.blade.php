<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY">
    <meta name="theme-color" content="#3fb0a5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    {{-- <meta name="apple-mobile-web-app-title" content="Surfside Media"> --}}
    <meta name="msapplication-TileImage" content="assets/images/favicon4.ico">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media"> --}}
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="{{asset('assets/images/favicon4.ico')}}">
    <link rel="icon" href="{{asset('assets/images/favicon4.ico')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Gawang Gamat</title>

    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendors/ion.rangeSlider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/index.css')}}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('assets/css/demo4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('assets/css/demo2.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>

<body class="theme-color4 light ltr" id="page-top">
    {{-- Navbar --}}
    @include('components.navbar.main')
    {{-- End of Navbar --}}

    {{-- Mobile Menu --}}
    
    {{-- End of Mobile Menu --}}

    {{-- Main Content --}}
    @yield('contents')

    {{-- End of Main Content --}}

    {{-- Footer --}}

    <div class="tap-to-top">
        <a href="#page-top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <div class="bg-overlay"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/feather/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/lazysizes.min.js')}}"></script>
    <script src="{{ asset('assets/js/slick/slick.js')}}"></script>
    <script src="{{ asset('assets/js/slick/slick-animation.min.js')}}"></script>
    <script src="{{ asset('assets/js/slick/custom_slick.js')}}"></script>
    <script src="{{ asset('assets/js/price-filter.js')}}"></script>
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('assets/js/filter.js')}}"></script>
    <script src="{{ asset('assets/js/newsletter.js')}}"></script>
    <script src="{{ asset('assets/js/cart_modal_resize.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('assets/js/theme-setting.js')}}"></script>
    <script src="{{ asset('assets/js/script.js')}}"></script>
    <script src="{{ asset('assets/js/index.js')}}"></script>
    <script>
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
    @yield('scripts')
</body>

</html>
