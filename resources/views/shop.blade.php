@extends('layouts.app2')

@section('contents')
<section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                <h1 class="page-title">Shop Page</h1>
            </div>
        </div>
    </div>
</section>

<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="category-product col-lg-9 col-12 ratio_30">
                <div class="row g-4">
                    @foreach ($product as $product)
                    <div class="col-xl-4 col-sm-6 col-6">
                        <div class="product-box">
                            <div class="product-image">
                                <a href="{{ route('shop.product', $product->id) }}">
                                    <img src="{{ asset('assets/images/products/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                </a>
                                <div class="product-label">
                                    @if ($product->discount)
                                    <span class="label3">-{{ $product->discount }}%</span>
                                    @endif
                                </div>
                                <div class="product-buttons">
                                    <a href="javascript:void(0)" class="btn-wishlist"><i data-feather="heart"></i></a>
                                    <a href="javascript:void(0)" class="btn-quickview" data-bs-toggle="modal" data-bs-target="#quick-view"><i data-feather="eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-title">
                                    <a href="{{ route('shop.product', $product->id) }}">{{ $product->name }}</a>
                                </div>
                                <div class="product-price">
                                    <span class="new-price">${{ $product->price }}</span>
                                    @if ($product->discount)
                                    <span class="old-price">${{ $product->old_price }}</span>
                                    @endif
                                </div>
                                <div class="customization-options">
                                    <label for="customizingImage_{{ $product->id }}">Customize Image:</label>
                                    <input type="file" name="customizingImage" id="customizingImage_{{ $product->id }}" accept="image/*">
                                    <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
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
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const customizingImage = document.getElementById(`customizingImage_${productId}`).files[0];

            const formData = new FormData();
            formData.append('product_id', productId);
            if (customizingImage) {
                formData.append('customizingImage', customizingImage);
            }

            fetch('/add-to-cart', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // You might want to update the cart display here
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection
