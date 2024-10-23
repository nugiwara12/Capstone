<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($products as $product)
        <div class="border p-4 rounded">
            <h2 class="font-semibold text-lg">{{ $product->title }}</h2>
            <p>Code: {{ $product->product_code }}</p>
            <p>Category: {{ $product->category }}</p>
            <p>Price: ${{ number_format($product->price, 2) }}</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="mt-2 bg-green-500 text-white rounded p-2">Add to Cart</button>
            </form>
        </div>
    @endforeach
</div>
