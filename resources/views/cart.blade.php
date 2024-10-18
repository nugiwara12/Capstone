@extends('layouts.app3')

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
                            <a href="{{route('home')}}">
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
                                    <img src="{{ asset('images/' . $item->image) }}" class="blur-up lazyloaded"
                                        alt="">
                                </a>
                            </td>
                            <td>
                                <a href="../product/details.html">{{$item->product_title}}</a>
                                {{-- <div class="mobile-cart-content row">
                                    <div class="col">
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="text" name="quantity" class="form-control input-number"
                                                    value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h2>$18</h2>
                                    </div>
                                    <div class="col">
                                        <h2 class="td-color">
                                            <a href="javascript:void(0)">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </h2>
                                    </div>
                                </div> --}}
                            </td>
                            <td>
                                <h2>&#8369;{{$item->price}}</h2>
                            </td>
                            <td>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <input type="number" name="quantity"
                                            {{-- data-rowid="ba02b0dddb000b25445168300c65386d" --}}
                                            class="form-control input-number" value="{{$item->quantity}}">
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
                                {{-- <a href="{{route('remove_product', $item->id)}}">

                                </a> --}}
                            </td>
                        </tr>
                        @php
                        $totalAmount += $item->price * $item->quantity; // Add to total amount
                        @endphp

                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="5">No items in you cart</td>
                    </tr>

                @endif
                </tbody>
                </table>
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

                                        <h6>Total <span>&#8369;{{$totalAmount + $shippingCost}}</span></h6>
                                    </div>
                                    <div class="bottom-details">
                                        @if($cart->count() > 0)
                                            <a href="{{route('checkout')}}">Process Checkout</a>
                                        @else
                                            <a disabled>Process Checkout</a>
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
@endsection
