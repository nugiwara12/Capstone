<nav class="bg-white p-4 fixed top-0 w-full z-10">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo or brand -->
        <div class="text-gray-800 text-2xl font-bold">
        <a href="/">
            <img src="{{asset('assets/images/logo.png')}}" class="h-logo img-fluid blur-up lazyload"
            alt="logo">
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="lg:hidden">
            <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                <i data-feather="menu"></i>
            </button>
        </div>

        <!-- Centered main navigation (hidden on mobile, visible on PC) -->
        <div class="hidden lg:flex justify-center flex-grow gap-8 text-gray-800">
            <a href="{{(route('user.index'))}}" class="flex items-center space-x-2 hover:text-gray-600">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
            <a href="{{(route('cart'))}}"class="flex items-center space-x-2 hover:text-gray-600">
                <i data-feather="shopping-bag"></i>
                <span>Cart</span>
            </a>
            <a href="user-dashboard.php" class="flex items-center space-x-2 hover:text-gray-600">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white p-4">
        <a href="demo3.php" class="block text-gray-800 hover:text-gray-600 mb-2">Home</a>
        <a href="javascript:void(0)" class="block text-gray-800 hover:text-gray-600 mb-2">Cart</a>
        <a href="user-dashboard.php" class="block text-gray-800 hover:text-gray-600">Account</a>
    </div>
</nav>

<script>
    // JavaScript to toggle the mobile menu
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
