@extends('layouts.app5')
<style>
    .thank-you-message {
        background-color: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 50px auto;
        text-align: center;
    }
    .thank-you-message h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }
    .email-info img {
        height: 80px;
    }
    .additional-info a {
        color: #00a69c;
        text-decoration: none;
        font-weight: bold;
    }
</style>
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
<main>
    <section class="thank-you-message">
        <h1>Thank you for your Purchase!</h1>
        <div class="email-info d-flex align-items-center justify-content-center mb-4">
            <img src="{{asset('assets/images/cart.png')}}" alt="Email Icon" class="mr-3">
            <p class="fs-5 ps-3 pt-0">Your order was completed successfully.</p>
        </div>
        <div>
            <a href="{{route('shop')}}" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                <i class="fas fa-arrow-left"></i> Continue Shopping</a>
        </div>
    </section>
</main>
@endsection
