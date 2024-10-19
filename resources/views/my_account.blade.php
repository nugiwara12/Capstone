@extends('layouts.app3')

@section('contents')
    <!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>User Dashboard</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Dashboard</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"><i class="fas fa-angle-right"></i>Orders</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"><i class="fas fa-angle-right"></i>Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"><i class="fas fa-angle-right"></i>Security</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dash">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title title title1 title-effect">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="welcome-msg">
                                        <h6 class="font-light">Hello, <span class="text-uppercase">{{ auth()->user()->name }} !</span></h6>
                                    </div>

                                    <div class="order-box-contain my-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/box.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/box1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">total order</h5>
                                                            <h3>{{$orderCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/sent.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/sent1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">pending orders</h5>
                                                            <h3>{{$orderPendingCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h3>Account Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Contact Information</h4><a href="javascript:void(0)">Edit</a>
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">{{ auth()->user()->name }}</h6>
                                                        <h6 class="font-light">{{ auth()->user()->email }}</h6>
                                                        <a href="javascript:void(0)">Change Password</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
                            <div class="box-head mb-3">
                                <h3>My Order</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset('images/' . $item->image) }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">{{$item->product_title}}</p>
                                            </td>
                                            <td>
                                                <p class="btn btn-sm
                                                    {{ $item->delivery_status === 'Pending' ? 'btn-warning' : ($item->delivery_status === 'Delivered' ? 'btn-success' : 'btn-primary') }} rounded-pill">
                                                    {{ $item->delivery_status }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">&#8369;{{ $item->price }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
{{--
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="assets/images/fashion/product/front/2.jpg" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mt-0">#125367</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Outwear & Coats</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Pending</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="assets/images/fashion/product/front/3.jpg" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125948</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">Shipped</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="assets/images/fashion/product/front/4.jpg" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#127569</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">Shipped</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="assets/images/fashion/product/front/5.jpg" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125753</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Canceled</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="assets/images/fashion/product/front/6.jpg" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125021</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Canceled</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                            <div class="box-head">
                                <h3>Profile</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                            </div>
                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Full Name</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->name }}</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Phone</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->phone }}</h6>
                                    </div>
                                </li>
                            </ul>

                            <div class="box-head mt-lg-5 mt-3">
                                <h3>Login Details</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                            </div>

                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Email Address</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->email }}</h6>
                                    </div>
                                </li>

                                <li class="mb-0">
                                    <div class="left">
                                        <h6 class="font-light">Password</h6>
                                    </div>
                                    <div class="right">
                                        <h6>●●●●●●</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade dashboard-security dashboard" id="security">
                            <div class="box-head">
                                <h3>Delete Your Account</h3>
                            </div>
                            <div class="security-details">
                                <h5 class="font-light mt-3">Hi <span> {{ auth()->user()->name }},</span>
                                </h5>
                                <p class="font-light mt-1">We Are Sorry To Here You Would Like To Delete Your Account.
                                </p>
                            </div>

                            <div class="security-details-1 mb-0">
                                <div class="page-title">
                                    <h4 class="fw-bold">Note</h4>
                                </div>
                                <p class="font-light">Deleting your account will permanently remove your profile,
                                    personal settings, and all other associated information. Once your account is
                                    deleted, You will be logged out and will be unable to log back in.</p>

                                <p class="font-light mb-4">If you understand and agree to the above statement, and would
                                    still like to delete your account, than click below</p>

                                <button class="btn btn-solid-default btn-sm fw-bold rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Your
                                    Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user dashboard section end -->
@endsection
