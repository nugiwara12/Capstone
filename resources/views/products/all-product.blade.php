@extends('layouts.app4')

@section('contents')
<body>
    <head>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/all-product.css') }}">
    </head>


    <!------------main--------------->
    <div class="main">
        <div class="left">
            <div class="img">
                <img src="{{url('admin_assets/img/pink.jpg')}}">
                <p>John Deo</p>
            </div>
            <!-- another features -->
            <hr>
        </div>

        <!------------center---------------------->
        <div class="center">
            @foreach($products as $product)
                <div class="friends_post">
                    <div class="friend_post_top">
                        <div class="img_and_name">
                            <img src="{{url('admin_assets/img/pink.jpg')}}">
                            <div class="friends_name">
                                <p class="friends_name">{{ $product->title }}</p>
                            </div>
                        </div>
                        <div class="menu">
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                    </div>
                    <img src="{{ asset('images/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <hr>
                    <div class="like">
                        <div class="like_icon">₱ {{ number_format($product->price, 2, ',', '.') }}</div>
                        <div class="like_icon">
                            <button class="btn listing-content"><a class="text-white bg-yellow-500 px-4 py-2 rounded-lg" href="{{route('product-details', $product->id)}}">Add To Cart </a></button>
                        </div>
                    </div>
                    <hr>
                    <div class="comment_warpper">
                        <img src="{{url('admin_assets/img/pink.jpg')}}">
                        <div class="circle"></div>
                        <div class="comment_search">
                            <input type="text" placeholder="Write a comment">
                            <i class="fa-regular fa-face-smile"></i>
                            <i class="fa-solid fa-camera"></i>
                            <i class="fa-regular fa-note-sticky"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!------------------right------------------>
        <div class="right">
            <div class="first_warpper">
                <div class="page">
                    <h2>Your Pages and profiles</h2>
                </div>

                <div class="page_img">
                    <img src="{{url('admin_assets/img/pink.jpg')}}">
                    <p>Web Designer</p>
                </div>

                <div class="page_icon">
                    <i class="fa-regular fa-bell"></i>
                    <p>20 Notifications</p>
                </div>

                <div class="page_icon">
                    <i class="fa-solid fa-bullhorn"></i>
                    <p>Create promotion</p>
                </div>

            </div>
            <hr>
            <hr>
        </div>
    </div>
</body>
@endsection

@section('scripts')
<script>
    let page = 1; // Initialize page number
    let loading = false; // Flag to prevent multiple requests

    function loadMoreProducts() {
        if (loading) return; // Prevent multiple requests
        loading = true;

        page++; // Increment page number

        fetch(`{{ route('all-products') }}?page=${page}`)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProducts = doc.querySelector('.center'); // Select the products container

                if (newProducts) {
                    document.querySelector('.center').insertAdjacentHTML('beforeend', newProducts.innerHTML); // Append new products
                } else {
                    // No more products to load
                    window.removeEventListener('scroll', handleScroll);
                }

                loading = false; // Reset loading flag
            })
            .catch(error => {
                console.error('Error loading products:', error);
                loading = false; // Reset loading flag in case of error
            });
    }

    function handleScroll() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) { // Adjusted to load a bit before reaching the bottom
            loadMoreProducts(); // Load more products when scrolled to the bottom
        }
    }

    window.addEventListener('scroll', handleScroll);
</script>
@endsection

