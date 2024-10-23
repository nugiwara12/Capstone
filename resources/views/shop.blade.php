@extends('layouts.app2')

@section('contents')
<section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
    <div class="overlay"></div> <!-- Overlay div -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                <h1 class="page-title">Shop Page</h1>
                <div class="breadcrumbs">
                    <span class="item">Shop</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 category-side col-md-4">
                <div class="category-option">
                    <div class="button-close mb-3">
                        <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                    </div>
                    <div class="accordion category-name" id="accordionExample">
                        <div class="accordion-item category-rating">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">
                                        @foreach ($category as $cat)
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="br1" name="brands"
                                                    value="1" type="checkbox">
                                                <label class="form-check-label">{{$cat->category_name}}</label>
                                                <p class="font-light">(1)</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="accordion-item category-color">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree">
                                    Color
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse show"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="category-list">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        <!-- <div class="accordion-item category-price">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour">Price</button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse show"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="range-slider category-list">
                                        <input type="text" class="js-range-slider" id="js-range-price" value="">
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        {{-- <div class="accordion-item category-price">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive">
                                    Size
                                </button>
                            </h2>

                            <div id="collapseFive" class="accordion-collapse collapse show"
                                aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="category-list">
                                        <li>
                                            <a href="javascript:void(0)">xs</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">sm</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">md</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">lg</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">xl</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">xxl</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="accordion-item category-rating">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct1" name="categories"
                                                    type="checkbox" value="1">
                                                <label class="form-check-label">Qui Ut</label>
                                                <p class="font-light">(7)</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct2" name="categories"
                                                    type="checkbox" value="2">
                                                <label class="form-check-label">Blanditiis Error</label>
                                                <p class="font-light">(8)</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct3" name="categories"
                                                    type="checkbox" value="3">
                                                <label class="form-check-label">Quam Quos</label>
                                                <p class="font-light">(0)</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct4" name="categories"
                                                    type="checkbox" value="4">
                                                <label class="form-check-label">Cupiditate Minus</label>
                                                <p class="font-light">(5)</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct5" name="categories"
                                                    type="checkbox" value="5">
                                                <label class="form-check-label">Dolores Et</label>
                                                <p class="font-light">(4)</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="ct6" name="categories"
                                                    type="checkbox" value="6">
                                                <label class="form-check-label">Quis Repudiandae</label>
                                                <p class="font-light">(0)</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
{{--
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven">
                                    Discount Range
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse show"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="category-list">
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" type="checkbox"
                                                    id="flexCheckDefault19">
                                                <label class="form-check-label" for="flexCheckDefault19">5% and
                                                    above</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" type="checkbox"
                                                    id="flexCheckDefault20">
                                                <label class="form-check-label" for="flexCheckDefault20">10% and
                                                    above</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" type="checkbox"
                                                    id="flexCheckDefault21">
                                                <label class="form-check-label" for="flexCheckDefault21">20% and
                                                    above</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="category-product col-lg-9 col-12 ratio_30">

                <div class="row g-4">
                    <!-- label and featured section -->
                    <div class="col-md-12">
                        <ul class="short-name">


                        </ul>
                    </div>

                    <!-- <div class="col-12">
                        <div class="filter-options">
                            <div class="select-options">
                                <div class="page-view-filter">
                                    <div class="dropdown select-featured">
                                        <select class="form-select" name="orderby" id="orderby">
                                            <option value="-1" selected="">Default</option>
                                            <option value="1">Date, New To Old</option>
                                            <option value="2">Date, Old To New</option>
                                            <option value="3">Price, Low To High</option>
                                            <option value="4">Price, High To Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="dropdown select-featured">
                                    <select class="form-select" name="size" id="pagesize">
                                        <option value="12" selected="">12 Products Per Page</option>
                                        <option value="24">24 Products Per Page</option>
                                        <option value="52">52 Products Per Page</option>
                                        <option value="100">100 Products Per Page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-options d-sm-inline-block d-none">
                                <ul class="d-flex">
                                    <li class="two-grid">
                                        <a href="javascript:void(0)">
                                            <img src="{{asset('assets/svg/grid-2.svg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="three-grid d-md-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="{{asset('assets/svg/grid-3.svg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn active d-lg-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="{{asset('assets/svg/grid.svg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="{{asset('assets/svg/list.svg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- label and featured section -->

                <!-- Prodcut section -->
                <div
                    class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                    @foreach ($product as $product)
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{route('product-details', $product->id)}}">
                                        <img src="{{ asset('images/' . $product->main_image) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                {{-- <div class="back">
                                    <a href="product/nihil-beatae-sit-sed.html">
                                        <img src="assets/images/fashion/product/back/12.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div> --}}
                                <div class="cart-wrap">
                                    <ul>
                                        {{-- <li><a href="{{route('cart')}}" class="addtocart-btn"><i data-feather="shopping-cart"></i></a></li> --}}
                                        <li><a href="{{route('product-details', $product->id)}}"><i data-feather="eye"></i></a></li>
                                        {{-- <li><a href="javascript:void(0)" class="wishlist"><i data-feather="heart"></i></a></li> --}}

                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">{{$product->category}}</span>
                                </div>
                                <div class="main-price">
                                    <a href="product/nihil-beatae-sit-sed.html" class="font-default">
                                        <h5 class="ms-0">{{$product->title}}</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">{{$product->category}}</span>
                                        <p class="font-light">{{$product->description}}</p>
                                    </div>
                                    <h3 class="theme-color">&#8369;{{$product->price}}</h3>
                                    <button class="btn listing-content"><a class="text-white" href="{{route('product-details', $product->id)}}">Add To Cart </a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- pagination -->
            </div>
        </div>
    </div>
</section>

<div id="qvmodal"></div>
@endsection
