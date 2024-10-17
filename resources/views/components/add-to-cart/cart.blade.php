<form action="{{ route('add_to_cart', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-solid hover-solid btn-animation">
        <i class="fa fa-shopping-cart"></i> <span>Add To Cart</span>
    </button>
</form>
