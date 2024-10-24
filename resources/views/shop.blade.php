@extends('layouts.app2')

@section('contents')
<section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
    <div class="overlay"></div>
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
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">
                                        @foreach ($category as $category) {{-- Change variable name to singular --}}
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input 
                                                    class="checkbox_animated check-it" 
                                                    id="cat-{{ $category->id }}" 
                                                    name="brands" 
                                                    value="{{ $category->id }}" 
                                                    type="checkbox"
                                                    onclick="filterProducts({{ $category->id }})">
                                                <label class="form-check-label" for="cat-{{ $category->id }}">{{ $category->category_name }}</label>
                                                <p class="font-light">(1)</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product col-lg-9 col-12 ratio_30">
                <div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                @foreach ($product as $product)
                    <div data-category="">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{ route('product-details', $product->id) }}">
                                        <img src="{{ asset('images/' . $product->main_image) }}" class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    {{-- Optional rating display --}}
                                </div>
                                <div class="main-price">
                                    <a href="{{ route('product-details', $product->id) }}" class="font-default">
                                        <h5 class="ms-0">{{ $product->title }}</h5>
                                    </a>
                                    <div class="listing-content">
                                        <p class="font-light">{{ $product->description }}</p>
                                    </div>
                                    <h3 class="theme-color">&#8369;{{ $product->price }}</h3>
                                    <button class="btn listing-content">
                                        <a class="text-white" href="{{ route('product-details', $product->id) }}">Add To Cart </a>
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
</section>

<script>
    function filterProducts(categoryId) {
        // Get all product boxes
        const allProducts = document.querySelectorAll('.product-box');

        // Show or hide products based on the checkbox state
        allProducts.forEach(product => {
            const productCategory = product.getAttribute('data-category'); // Use 'data-category'

            // Check if the checkbox is checked
            const checkbox = document.getElementById(`cat-${categoryId}`);
            if (checkbox.checked) {
                // If the checkbox is checked, show matching products
                if (productCategory === categoryId.toString()) {
                    product.style.display = 'block'; // Show product
                } else {
                    product.style.display = 'none'; // Hide product
                }
            } else {
                // If the checkbox is unchecked, show all products
                allProducts.forEach(p => {
                    p.style.display = 'block'; // Show all products
                });
            }
        });
    }
</script>

<div id="qvmodal"></div>
@endsection
