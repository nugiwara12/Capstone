@extends('layouts.app5')

@section('contents')

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Display All Items</h1>
    <!-- Example items display -->
    <div class="flex flex-wrap justify-between">
        @foreach($products as $product)
            <div class="product bg-white rounded-lg shadow-md overflow-hidden flex flex-col w-full sm:w-1/2 md:w-1/3 lg:w-1/4 transition-transform transform hover:scale-105 duration-300">
                <!-- Display the main image -->
                <img src="{{ asset('images/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4 flex-grow">
                    <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                    <p class="text-gray-600">{{ $product->price }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')

@endsection

