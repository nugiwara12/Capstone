@extends('layouts.app4') <!-- Extends the navbar layout -->

@section('content')
    <div class="middle-panel">
        <h1>Feature Items</h1>

        <!-- Your Best Seller product listings go here -->
        <div class="products">
            @foreach($products as $product)
                <div class="product">
                    <!-- Display the main image instead of a gallery image -->
                    <img src="{{ asset('images/' . $product->main_image) }}" alt="{{ $product->name }}" width="300" height="300">
                    <h2>{{ $product->title }}</h2>
                    <p>{{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
