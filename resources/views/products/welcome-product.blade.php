@foreach($products as $product)
    <div class="product bg-white rounded-lg shadow-md overflow-hidden flex flex-col w-1/5 min-w-[160px] flex-shrink-0">
        <!-- Display the main image -->
        <img src="{{ asset('images/' . $product->main_image) }}" alt="{{ $product->name }}" width="300" height="300" class="w-full h-48 object-cover">
        <div class="p-4 flex-grow">
            <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
            <p class="text-gray-600">{{ $product->price }}</p>
        </div>
    </div>
@endforeach