@extends('layouts.app7')

@section('contents')
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <!-- Center -->
        <div class="grid grid-cols-1 gap-6 product-list"> <!-- Updated the class to 'product-list' -->
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg p-4">
                <!-- Post Header -->
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{url('admin_assets/img/pink.jpg')}}" class="w-12 h-12 rounded-full object-cover" alt="Product Image">
                        <div>
                            <p class="text-lg font-semibold">{{ $product->title }}</p>
                        </div>
                    </div>
                    <div class="text-gray-500 cursor-pointer">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                </div>

                <!-- Product Image -->
                <img src="{{ asset('images/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded-lg">

                <hr class="mb-4">

                <!-- Like and Share Section -->
                <div class="flex justify-between items-center text-gray-700 mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-bold text-green-500">₱{{ number_format($product->price, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center space-x-2 cursor-pointer">
                        <button class="btn listing-content"><a class="text-white bg-yellow-500 px-4 py-2 rounded-lg" href="{{route('product-details', $product->id)}}">Add To Cart </a></button>
                    </div>
                </div>
            </div>
            @endforeach
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

        fetch("{{ route('user.index') }}?page=" + page)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProducts = doc.querySelector('.product-list'); // Updated to 'product-list'

                if (newProducts) {
                    document.querySelector('.product-list').append(...newProducts.children); // Append new products
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
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) { // Added a small buffer
            loadMoreProducts(); // Load more products when scrolled to the bottom
        }
    }

    window.addEventListener('scroll', handleScroll);
</script>
@endsection
