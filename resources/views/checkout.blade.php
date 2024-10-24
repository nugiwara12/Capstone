@extends('layouts.app6')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    .hide{
        display:none !important;
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
            title: '{{ Session::get('success') }}',
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
                <h3>Checkout</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('user.index')}}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section Start -->
<section class="section-b-space">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
            <form

                            role="form"

                            action="{{ route('stripe.post') }}"

                            method="post"

                            class="require-validation"

                            data-cc-on-file="false"

                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"

                            id="payment-form">

                        @csrf
                    <div id="shippingAddress" class="row g-4">
                        <h3 class="mb-3 theme-color">Shipping address</h3>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter House no./Unit no./Building Name ">
                        </div>

                        <div class="col-md-3">
                            <label for="province">Province</label>
                            <select class="form-select custome-form-select" id="province" name="province" onchange="updateCities()">
                                <option value="">Choose...</option>
                                <option value="Pampanga">Pampanga</option>
                                <!-- Add more provinces here -->
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="city">City</label>
                            <select class="form-select custome-form-select" id="city" name="city" onchange="updateBarangays()">
                                <option value="">Choose...</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="barangay">Barangay</label>
                            <select class="form-select custome-form-select" id="barangay" name="barangay">
                                <option value="">Choose...</option>
                            </select>
                        </div>
                    </div>

                    {{-- <div class="form-check ps-0 mt-3 custome-form-check">
                        <label class="form-check-label checkout-label" for="saveAddress">This information will be used for the next time</label>
                    </div> --}}

                    <hr class="my-lg-5 my-4">



            </div>

            <div class="col-lg-4">
                <div class="checkout__totals">
                    <h3 class="fw-bold">Your Order</h3>
                    <table class="checkout-cart-items">
                        <thead>
                            <tr>
                                <th class="fw-bold">PRODUCT</th>
                                <th class="fw-bold text-end">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAmount = 0; // Initialize total amount
                            @endphp
                            @foreach ($cart as $item)
                            <tr>
                                <td>
                                    {{$item->product_title}} x {{$item->quantity}}
                                </td>
                                <td class="text-end">
                                    &#8369;{{$item->price * $item->quantity}}
                                </td>
                            </tr>
                            @php
                            $totalAmount += $item->price * $item->quantity; // Add to total amount
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <table class="checkout-totals">
                        <tbody>
                            <tr>
                                <th>SUBTOTAL</th>
                                <td class="text-end">&#8369;{{$totalAmount}}</td>
                            </tr>
                            @php
                                $shippingCost = $cart->count() > 0 ? 100 : 0;
                            @endphp
                            <tr>
                                <th>SHIPPING</th>
                                <td class="text-end">&#8369;{{$shippingCost}}</td>
                            </tr>
                            <tr>
                                <th class="border-bottom-0 fw-bold">TOTAL</th>
                                <td class="border-bottom-0 text-end fw-bold">&#8369;{{$value=$totalAmount + $shippingCost}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h3 class="mb-3">Pay Using Card</h3>
            <div class="d-block">
                <div class="d-block">
                    {{-- <div>
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" id="debitCard" name="payment" value="debit"> Pay Using Card
                        </div>
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" id="paypal" name="payment" value="paypal"> PayPal
                        </div>
                    </div> --}}

                      <!-- Debit card input field for Stripe -->
                    <div class="row g-4" id="debitCardFields" >
                        <ul class="my-2">
                            <li class="text-muted">Credit Card/Debit Card</li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/payment-icon/1.jpg')}}" class="img-fluid blur-up lazyload ps-4"
                                        alt="payment icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/payment-icon/2.jpg')}}" class="img-fluid blur-up lazyload ps-4"
                                        alt="payment icon">
                                </a>
                            </li>
                        </ul>
                        <div class='form-row row'>
                            <div class='col-md-6 form-group required'>
                                <label class='control-label'>Name on Card</label>
                                <input class='form-control' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row row mt-3'>
                            <div class='col-md-6 form-group card required' style="border:none;">
                                <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>
                        <div class='form-row row mt-3'>
                            <div class='col-md-2 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-md-2 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-md-2 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                            <div class='col-md-6 error form-group hide'>

                                <div class='alert-danger alert'>Please correct the errors and try again.
                                </div>

                            </div>

                    </div>

                      <!-- PayPal input field -->
                      {{-- <div class="row g-4" id="paypalFields" style="display:none;">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name">
                            <div id="emailHelp" class="form-text">Full name as displayed on card</div>
                        </div>
                    </div> --}}
                        <input type="hidden" name="total_amount" value="{{ $totalAmount + $shippingCost }}">
                      <button class="btn btn-solid-default mt-4" type="submit">Pay Now (&#8369;{{$value}})</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>



<script type="text/javascript">



$(function() {



    /*------------------------------------------

    --------------------------------------------

    Stripe Payment Code

    --------------------------------------------

    --------------------------------------------*/



    var $form = $(".require-validation");



    $('form.require-validation').bind('submit', function(e) {

        var $form = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',

                         'input[type=text]', 'input[type=file]',

                         'textarea'].join(', '),

        $inputs = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid = true;

        $errorMessage.addClass('hide');



        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {

          var $input = $(el);

          if ($input.val() === '') {

            $input.parent().addClass('has-error');

            $errorMessage.removeClass('hide');

            e.preventDefault();

          }

        });



        if (!$form.data('cc-on-file')) {

          e.preventDefault();

          Stripe.setPublishableKey($form.data('stripe-publishable-key'));

          Stripe.createToken({

            number: $('.card-number').val(),

            cvc: $('.card-cvc').val(),

            exp_month: $('.card-expiry-month').val(),

            exp_year: $('.card-expiry-year').val()

          }, stripeResponseHandler);

        }



    });



    /*------------------------------------------

    --------------------------------------------

    Stripe Response Handler

    --------------------------------------------

    --------------------------------------------*/

    function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            /* token contains id, last4, and card type */

            var token = response['id'];



            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }



});

</script>
<script>
// List of cities and barangays for Pampanga (example dataset)
const cityBarangays = {
    Pampanga: {
        Angeles: ['Balibago', 'Cutcut', 'Pulung Maragul'],
        SanFernando: ['Sto. Rosario', 'Sindalan', 'Telabastagan'],
        Mabalacat: ['Dau', 'Camachiles', 'Tabun']
    }
};

// Function to update cities based on the selected province
function updateCities() {
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    const selectedProvince = provinceSelect.value;

    // Clear the city and barangay dropdowns
    citySelect.innerHTML = '<option value="">Choose...</option>';
    barangaySelect.innerHTML = '<option value="">Choose...</option>';

    if (cityBarangays[selectedProvince]) {
        const cities = Object.keys(cityBarangays[selectedProvince]);
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }
}

// Function to update barangays based on the selected city
function updateBarangays() {
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    const selectedProvince = provinceSelect.value;
    const selectedCity = citySelect.value;

    // Clear the barangay dropdown
    barangaySelect.innerHTML = '<option value="">Choose...</option>';

    if (cityBarangays[selectedProvince] && cityBarangays[selectedProvince][selectedCity]) {
        const barangays = cityBarangays[selectedProvince][selectedCity];
        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        });
    }
}

// Select the payment radio buttons
const debitCardRadio = document.getElementById('debitCard');
const paypalRadio = document.getElementById('paypal');

// Select the corresponding input field divs
const debitCardFields = document.getElementById('debitCardFields');
const paypalFields = document.getElementById('paypalFields');

// Add event listeners to toggle fields when a payment method is selected
debitCardRadio.addEventListener('change', function() {
    if (this.checked) {
        debitCardFields.style.display = 'block';
        paypalFields.style.display = 'none';
    }
});

paypalRadio.addEventListener('change', function() {
    if (this.checked) {
        paypalFields.style.display = 'block';
        debitCardFields.style.display = 'none';
    }
});
</script>

@endsection
