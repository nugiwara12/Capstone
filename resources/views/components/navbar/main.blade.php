<header class="header-style-2" id="home">
    <div class="main-header navbar-searchbar">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="/">
                                    <img src="{{asset('assets/images/logo.png')}}" class="h-logo img-fluid blur-up lazyload" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="menu-right">
                            <ul>
                                <div class="main-navbar">
                                    <div id="mainnav">
                                        <div class="toggle-nav">
                                            <i class="fa fa-bars sidebar-bar"></i>
                                        </div>
                                        <ul class="nav-menu">
                                            <li class="back-btn d-xl-none">
                                                <div class="close-btn">
                                                    Menu
                                                    <span class="mobile-back">
                                                        <i class="fa fa-angle-left"></i>
                                                    </span>
                                                </div>
                                            </li>
                                            <li><a href="/" class="nav-link menu-title">Home</a></li>
                                            <li><a href="{{(route('shop'))}}" class="nav-link menu-title">Shop</a></li>
                                            <li><a href="{{(route('about_us'))}}" class="nav-link menu-title">About Us</a></li>
                                            <li><a href="{{(route('contact'))}}" class="nav-link menu-title">Contact Us</a></li>
                                            <li><a href="{{(route('cart'))}}" class="nav-link menu-title">Cart</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <li><!-- Space between the menu and icons --></li>

                                <li class="onhover-dropdown">
                                    <div class="cart-media name-usr">
                                        @auth
                                            <span>{{ auth()->user()->name }}</span>
                                            <i data-feather="user"></i>
                                        @else
                                            <i data-feather="user"></i>
                                        @endauth
                                    </div>
                                    <div class="onhover-div profile-dropdown">
                                        <ul>
                                            @guest
                                                <li><a href="{{ route('login') }}" class="d-block">Login</a></li>
                                                <li><a href="{{ route('register') }}" class="d-block">Register</a></li>
                                            @endguest
                                            @auth
                                                <li><a href="" class="d-block">Profile</a></li>
                                                <li><a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            @endauth
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
