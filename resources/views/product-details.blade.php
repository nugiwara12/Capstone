@extends('layouts.app2')

@section('contents')
@if(Session::has('success'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        // iconColor: 'white',
        customClass: {
            popup: 'colored-toast',
        },
        showCloseButton: true,
        showConfirmButton: false,
        timer: 2500,
        // timerProgressBar: true,
        })
         Toast.fire({
            icon: 'success',
            title: '{{Session::get('success')}}',
        })

    </script>
@endif
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
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
                <h3>{{$product->title}}</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> <!-- Shop Section start -->

<section>
    <div class="container">
        <div class="row gx-4 gy-5">
            <div class="col-lg-12 col-12">
                <div class="details-items">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="details-image-vertical black-slide rounded">
                                        {{-- main image --}}
                                        <div>
                                            <img src="{{ asset('images/' . $product->main_image) }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        {{-- Start of image gallery --}}
                                        <div>
                                            <img src="../assets/images/fashion/2.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/3.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/4.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="details-image-1 ratio_asos">
                                        {{-- main image --}}
                                        <div>
                                            <img src="{{ asset('images/' . $product->main_image) }}" id="zoom_01"
                                                data-zoom-image="assets/images/fashion/1.jpg"
                                                class="img-fluid w-100 image_zoom_cls-0 blur-up lazyload" alt="">
                                        </div>
                                        {{-- Start of image gallery --}}
                                        <div>
                                            <img src="../assets/images/fashion/2.jpg" id="zoom_02"
                                                data-zoom-image="assets/images/fashion/2.jpg"
                                                class="img-fluid w-100 image_zoom_cls-1 blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/3.jpg" id="zoom_03"
                                                data-zoom-image="assets/images/fashion/3.jpg"
                                                class="img-fluid w-100 image_zoom_cls-2 blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/4.jpg" id="zoom_04"
                                                data-zoom-image="assets/images/fashion/4.jpg"
                                                class="img-fluid w-100 image_zoom_cls-3 blur-up lazyload" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="cloth-details-size">
                                {{-- <div class="product-count">
                                    <ul>
                                        <li>
                                            <img src="../assets/images/gif/fire.gif"
                                                class="img-fluid blur-up lazyload" alt="image">
                                            <span class="p-counter">37</span>
                                            <span class="lang">orders in last 24 hours</span>
                                        </li>
                                        <li>
                                            <img src="../assets/images/gif/person.gif"
                                                class="img-fluid user_img blur-up lazyload" alt="image">
                                            <span class="p-counter">44</span>
                                            <span class="lang">active view this</span>
                                        </li>
                                    </ul>
                                </div> --}}

                                <div class="details-image-concept">
                                    <h2>{{$product->title}}</h2>
                                </div>

                                <div class="label-section">
                                    <span class="label-text">#1 Best seller in</span>
                                    <span class="badge badge-grey-color"> {{$product->category}}</span>
                                </div>

                                <h3 class="price-detail">&#8369;{{$product->price}}</h3>

                                {{-- <div class="color-image">
                                    <div class="image-select">
                                        <h5>Color :</h5>
                                        <ul class="image-section">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="../assets/images/fashion/product/front/5.jpg"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="../assets/images/fashion/product/front/6.jpg"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="../assets/images/fashion/product/front/7.jpg"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}

                                <div id="selectSize" class="addeffect-section product-description border-product">
                                    {{-- <h6 class="product-title size-text">select size
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#sizemodal">size chart</a>
                                    </h6>

                                    <h6 class="error-message">please select size</h6>

                                    <div class="size-box">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">s</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">m</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">l</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">xl</a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <form method="POST" action="{{ route('add_to_cart', $product->id) }}">
                                        @csrf
                                    <h6 class="product-title product-title-2 d-block">quantity</h6>

                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus"
                                                    onclick="updateQuantity()" data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity"
                                                class="form-control input-number" value="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus"
                                                    onclick="updateQuantity()" data-type="plus" data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buttons">
                                    {{-- <a href="javascript:void(0)" class="btn btn-solid">
                                        <i class="fa fa-bookmark fz-16 me-2"></i>
                                        <span>Wishlist</span>
                                    </a> --}}
                                    {{-- <a href="javascript:void(0)"
                                        id="cartEffect" class="btn btn-solid hover-solid btn-animation">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Add To Cart</span>
                                        <form id="addtocart" method="post"
                                            action="http://localhost:8000/cart/store">
                                            <input type="hidden" name="_token"
                                                value="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY"> <input
                                                type="hidden" name="id" value="1">
                                            <input type="hidden" name="name"
                                                value="Autem Repudiandae Accusantium Blanditiis">
                                            <input type="hidden" name="price" value="13">
                                            <input type="hidden" name="quantity" id="qty" value="1">
                                        </form>
                                    </a> --}}

                                    {{-- <x-add-to-cart.cart :product="$product" /> --}}

                                        <!-- Include your product details here -->
                                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                                        {{-- <input type="number" name="quantity" value="1" hidden> --}}
                                        <button type="submit" class="btn btn-solid hover-solid btn-animation">
                                            <i class="fa fa-shopping-cart"></i> <span>Add To Cart</span>
                                        </button>
                                    </form>

                                </div>

                                {{-- <ul class="product-count shipping-order">
                                    <li>
                                        <img src="../assets/images/gif/truck.png" class="img-fluid blur-up lazyload"
                                            alt="image">
                                        <span class="lang">Free shipping for orders above $500 USD</span>
                                    </li>
                                </ul> --}}

                                <div class="mt-2 mt-md-3 border-product">
                                    <h6 class="product-title hurry-title d-block">Hurry Up! Left <span>10</span> in
                                        stock</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                    </div>
                                    {{-- <div class="font-light timer-5">
                                        <h5>Order in the next to get</h5>
                                        <ul class="timer1">
                                            <li class="counter">
                                                <h5 id="days">&#9251;</h5> Days :
                                            </li>
                                            <li class="counter">
                                                <h5 id="hours">&#9251;</h5> Hour :
                                            </li>
                                            <li class="counter">
                                                <h5 id="minutes">&#9251;</h5> Min :
                                            </li>
                                            <li class="counter">
                                                <h5 id="seconds">&#9251;</h5> Sec
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>

                                {{-- <div class="border-product">
                                    <h6 class="product-title d-block">share it</h6>
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li>
                                                <a href="https://www.facebook.com/">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.google.com/">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li class="pe-0">
                                                <a href="https://www.google.com/">
                                                    <i class="fas fa-rss"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="cloth-review">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#desc" type="button">Description</button>

                            <button class="nav-link" id="nav-speci-tab" data-bs-toggle="tab" data-bs-target="#speci"
                                type="button">Specifications</button>

                            {{-- <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-guide" type="button">Sizing Guide</button>

                            <button class="nav-link" id="nav-question-tab" data-bs-toggle="tab"
                                data-bs-target="#question" type="button">Q & A</button>

                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#review" type="button">Review</button> --}}
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <div class="shipping-chart">
                                <div class="part">
                                    <h4 class="inner-title mb-2">{{$product->title}}</h4>
                                    <p class="font-light">{{$product->description}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="speci">
                            <div class="pro mb-4">
                                <p class="font-light">The Model is wearing a white blouse from our stylist's
                                    collection, see the image for a mock-up of what the actual blouse would look
                                    like.it has text written on it in a black cursive language which looks great
                                    on a white color.</p>
                                <div class="table-responsive">
                                    <table class="table table-part">
                                        <tr>
                                            <th>Product Dimensions</th>
                                            <td>15 x 15 x 3 cm; 250 Grams</td>
                                        </tr>
                                        <tr>
                                            <th>Date First Available</th>
                                            <td>5 April 2021</td>
                                        </tr>
                                        <tr>
                                            <th>Manufacturer‏</th>
                                            <td>Aditya Birla Fashion and Retail Limited</td>
                                        </tr>
                                        <tr>
                                            <th>ASIN</th>
                                            <td>B06Y28LCDN</td>
                                        </tr>
                                        <tr>
                                            <th>Item model number</th>
                                            <td>AMKP317G04244</td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>Men</td>
                                        </tr>
                                        <tr>
                                            <th>Item Weight</th>
                                            <td>250 G</td>
                                        </tr>
                                        <tr>
                                            <th>Item Dimensions LxWxH</th>
                                            <td>15 x 15 x 3 Centimeters</td>
                                        </tr>
                                        <tr>
                                            <th>Net Quantity</th>
                                            <td>1 U</td>
                                        </tr>
                                        <tr>
                                            <th>Included Components‏</th>
                                            <td>1-T-shirt</td>
                                        </tr>
                                        <tr>
                                            <th>Generic Name</th>
                                            <td>T-shirt</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section end -->

<!-- product section start -->
<section class="ratio_asos section-b-space overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-lg-4 mb-3">Customers Also Bought These</h2>
                <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                    @foreach ($shuffle as $ap)
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{route('product-details', $ap->id)}}">
                                        <img src="{{ asset('images/' . $ap->main_image) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        {{-- <li>
                                            <a href="javascript:void(0)" class="addtocart-btn"
                                                data-bs-toggle="modal" data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a href="{{route('product-details', $ap->id)}}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        {{-- <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">{{$ap->category}}</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>{{$ap->title}}</h5>
                                    </a>
                                    {{-- <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Dolorem nihil quia qui laudantium expedita aut dolor.
                                            Qui eligendi voluptatem autem ullam et. Voluptas nemo eum nihil aliquam
                                            eos aperiam. Numquam dolorum veniam non magnam illum odit deleniti.</p>
                                    </div> --}}
                                    <h3 class="theme-color">&#8369;{{$ap->price}}</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->
@endsection
