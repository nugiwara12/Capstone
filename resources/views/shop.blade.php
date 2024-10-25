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
                            <h2 class="accordion-header mb-2" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <form method="GET" action="{{ route('filtering') }}">
                                <div class="flex flex-col space-y-4">
                                    <!-- Show All Checkbox -->
                                    <div class="form-check ps-0 custome-form-check flex items-center">
                                        <input class="checkbox_animated check-it" id="show_all" type="checkbox" onclick="toggleAll(this)">
                                        <label class="form-check-label ml-2" for="show_all">Show All</label>
                                    </div>

                                    <!-- Individual Category Checkboxes -->
                                    @foreach ($category as $cat)
                                    <div class="form-check ps-0 custome-form-check flex items-center">
                                        <input class="checkbox_animated check-it" id="cat_{{ $cat->category_name }}" name="category[]"
                                            value="{{ $cat->category_name }}" type="checkbox" {{ request()->input('category') && in_array($cat->category_name, request()->input('category')) ? 'checked' : '' }}>
                                        <label class="form-check-label ml-2" for="cat_{{ $cat->category_name }}">{{ $cat->category_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary h-8 w-auto px-3 rounded-md py-1 text-sm mt-4">Filter</button>
                            </form>                 
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product col-lg-9 col-12 ratio_30">
                <!-- Product section -->
                
                <div class="category-product col-lg-9 col-12 ratio_30">
                    <div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                        @foreach ($product as $products) <!-- Make sure to use the correct loop variable here -->
                        <div>
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="{{ route('product-details', $products->id) }}"> <!-- Change $product to $products -->
                                            <img src="{{ asset('images/' . $products->main_image) }}" class="bg-img blur-up lazyload" alt=""> <!-- Change $product to $products -->
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="main-price">
                                        <a href="{{ route('product-details', $products->id) }}" class="font-default">
                                            <h5 class="ms-0">{{ $products->title }}</h5> <!-- Change $product to $products -->
                                        </a>
                                        <h3 class="theme-color">&#8369;{{ $products->price }}</h3> <!-- Change $product to $products -->
                                        <button class="btn listing-content">
                                            <a class="text-white" href="{{ route('product-details', $products->id) }}">Add To Cart</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                </div>
                </div>
                <!-- Pagination -->
            </div>
        </div>
    </div>
</section>

<div id="qvmodal"></div>

<script>
    function toggleAll(source) {
        const checkboxes = document.querySelectorAll('.check-it');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
</script>
@endsection
