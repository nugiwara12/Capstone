@extends('layouts.app4') <!-- Extends the navbar layout -->

@section('content')
    <div class="middle-panel p-6 flex justify-between">
        <h1 class="text-3xl font-bold mb-4 center">Feature Items</h1>

        <!-- Your Feature product listings go here -->
        <div class="flex flex-wrap justify-between overflow-x-auto center">
            @foreach($products as $product)
                <div class="product bg-white rounded-lg shadow-md overflow-hidden flex-shrink-0 w-1/5 min-w-[160px] mx-2 flex-1">
                    <!-- Display the main image -->
                    <img src="{{ asset('images/' . $product->main_image) }}" width="300" height="300" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                        <p class="text-gray-600">{{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
