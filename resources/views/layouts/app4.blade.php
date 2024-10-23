<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('admin_assets/css/users.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>GawangGamat</title>

    @yield('styles')
</head>

<body>
    <!-- Navbar section -->
    <nav>
        <div class="nav-middle">
            <a href="{{ route('best-sellers') }}">
                <i class="">Best Seller</i>
            </a>

            <a href="{{ route('shops') }}">
                <i class="">Products</i>
            </a>


            <a href="{{ route('featured') }}">
                <i class="">Features</i>
            </a>
        </div>

        <div class="nav-right">
            <span class="profile"></span>

            <a href="#">
                <i class="fa fa-bell"></i>
            </a>

            <a href="#">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </nav>

    <!-- Content section -->
    <div class="container">
        <div>
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
