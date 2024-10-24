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

<body class="bg-gray-100 py-5">
    <!-- Navbar section -->
    <nav class="flex items-center justify-between p-10 bg-white shadow-md">
        <div class="flex items-center">
            <img class="h-10 w-auto" src="{{ URL::asset('admin_assets/img/logo/imglogo.png') }}" alt="Logo">
        </div>

        <div class="hidden md:flex space-x-4">
            <a href="{{ route('user.index') }}" class="text-gray-700 hover:text-blue-500">All Product</a>
            <a href="{{ route('best-sellers') }}" class="text-gray-700 hover:text-blue-500">Best Seller</a>
            <a href="{{ route('shops') }}" class="text-gray-700 hover:text-blue-500">Products</a>
            <a href="{{ route('featured') }}" class="text-gray-700 hover:text-blue-500">Features</a>
        </div>

        <div class="relative inline-block text-left">
            <div>
                <button type="button" class="inline-flex flex-col items-start w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    id="options-menu" aria-haspopup="true" aria-expanded="true" onclick="toggleDropdown()">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down mt-1"></i>
                </button>
            </div>

            <div id="dropdown-menu" class="hidden z-10 absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1" role="none">
                    <span class="block px-4 py-2 text-sm text-gray-700 font-bold">{{ Auth::user()->role }}</span>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="md:hidden flex justify-between p-4 bg-white shadow-md">
        <div class="space-y-4">
            <a href="{{ route('best-sellers') }}" class="block text-gray-700 hover:text-blue-500">Best Seller</a>
            <a href="{{ route('shops') }}" class="block text-gray-700 hover:text-blue-500">Products</a>
            <a href="{{ route('featured') }}" class="block text-gray-700 hover:text-blue-500">Features</a>
        </div>
    </div>

    <!-- Content section -->
    <div class="mx-auto p-3 flex-1">
        <div>
            @yield('contents')
        </div>
    </div>

    @yield('scripts')

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>
