    @extends('layouts.app6')

    @section('contents')
    @if(Session::has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                customClass: {
                    popup: 'colored-toast',
                },
                showCloseButton: true,
                showConfirmButton: false,
                timer: 2500,
            });

            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}",
            });
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                customClass: {
                    popup: 'colored-toast',
                },
                showCloseButton: true,
                showConfirmButton: false,
                timer: 2500,
            });

            Toast.fire({
                icon: 'error',
                title: "{{ Session::get('error') }}",
            });
        </script>
    @endif

    <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Cart</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('user.index')}}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">total</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        @php
                            $totalAmount = 0; // Initialize total amount
                        @endphp
                        @if($cart->count() > 0)
                        @foreach ($cart as $item)
                        <tbody>
                            <tr>
                                <td>
                                    <a href="../product/details.html">
                                        <img src="{{ asset('images/' . $item->image) }}" class="blur-up lazyloaded" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="../product/details.html">{{$item->product_title}}</a>
                                </td>
                                <td>
                                    <h2>&#8369;{{$item->price}}</h2>
                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantity" class="form-control input-number" value="{{$item->quantity}}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h2 class="td-color">&#8369; {{$item->price * $item->quantity}}</h2>
                                </td>
                                <td>
                                    <form id="deleteForm-{{ $item->id }}" action="{{ route('remove_product', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger m-0" onclick="confirmation(event, {{ $item->id }})"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @php
                            $totalAmount += $item->price * $item->quantity; // Add to total amount
                            @endphp
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="5">No items in your cart</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                                <!-- Customization Section Container -->
                <div class="w-full max-w-md mx-auto mt-8 p-4 bg-white rounded-lg shadow-md">
                    <h4 class="text-lg font-bold text-center mb-4">Customize Your Product</h4>
                    
                    <!-- Upload Customized Image Section -->
                    <div class="mb-6">
                        <label for="customImage" class="block font-semibold mb-2">Upload Customized Image</label>
                        <input type="file" id="customImage" accept="image/*" onchange="previewImage(event)" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <div id="imagePreview" class="mt-4 border rounded-lg p-4 bg-gray-100 text-center"></div>
                    </div>
                </div>

                <div class="col-12 mt-md-5 mt-4">
                    <div class="row">
                        <div class="col-sm-5 col-7">
                            <div class="left-side-button float-start">
                                <a href="{{route('shop')}}" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                    <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-checkout-section">
                    <div class="row g-4">
                        <div class="col-lg-4 col-sm-6">
                        </div>

                        <div class="col-lg-4 col-sm-6 ">
                        {{-- Spacing --}}
                        </div>

                        <div class="col-lg-4">
                            <div class="cart-box">
                                <div class="cart-box-details">
                                    <div class="total-details">
                                        <div class="top-details">
                                            <h3>Cart Totals</h3>
                                            <h6>Sub Total <span>&#8369;{{ $totalAmount }}</span></h6>
                                            @php
                                                $shippingCost = $cart->count() > 0 ? 100 : 0;
                                            @endphp
                                            <h6>Shipping <span>&#8369; {{$shippingCost}}</span></h6>

                                            {{-- Additional Payment Field --}}
                                            <h6>Additional Payment (If Needed)
                                                <span></span>
                                                <input type="number" id="additionalPayment" value="0" class="form-control d-inline" style="width: auto; margin-left: 5px; display: inline-block;">
                                            </h6>

                                            {{-- Total Calculation Including Additional Payment --}}
                                            <h6>Total
                                                <span id="totalAmount">
                                                    &#8369;{{ $totalAmount + $shippingCost }}
                                                </span>
                                            </h6>
                                        </div>
                                        <div class="bottom-details">
                                            @if($cart->count() > 0)
                                                <a href="{{route('checkout')}}" class="btn btn-primary">Process Checkout</a>
                                            @else
                                                <a disabled class="btn btn-secondary">Process Checkout</a>
                                                <span class="text-danger small">You cannot process checkout with an empty cart.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sweet Alert Delete Js --}}
    <script src="{{asset('admin_assets/js/delete.js')}}"></script>

    <script>
    // Function to preview the selected image
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = ""; // Clear previous images

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Customized Image Preview';
                img.style.width = '200px'; // Set your desired preview size
                img.style.height = 'auto';
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    // Function to update total whenever additional charges change
    function updateTotal() {
        const additionalPayment = parseFloat(document.getElementById('additionalPayment').value) || 0;
        const textCharge = parseFloat(document.getElementById('textCharge').dataset.charge) || 0;
        const imageCharge = parseFloat(document.getElementById('imageCharge').dataset.charge) || 0;
        const subtotal = {{ $totalAmount }};
        const shipping = {{ $shippingCost }};

        const total = subtotal + shipping + additionalPayment + textCharge + imageCharge;
        document.getElementById('totalAmount').innerText = `₱${total.toFixed(2)}`;
    }

    

    // Listener for manual additional payment input to trigger total update
    document.getElementById('additionalPayment').addEventListener('input', updateTotal);
</script>


    @endsection
