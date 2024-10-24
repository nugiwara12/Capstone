@extends('layouts.app2')

@section('contents')
    <section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                    <h1 class="page-title">About Us</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- team leader section Start -->
    <section class="overflow-hidden" style="margin-bottom: 50px;">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-5 offset-xl-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <img src="assets/images/about_1.png" class="img-fluid rounded-3 about-image" alt="">
                        </div>
                        <div class="col-md-6">
                            <img src="assets/images/about_2.png" class="img-fluid rounded-3 about-image" alt="">
                        </div>
                        <div class="col-12 ratio_40">
                            <div>
                                <img src="assets/images/about_3.png" class="img-fluid rounded-3 team-image bg-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="about-details">
                        <div>
                            <h2>WHO WE ARE</h2>
                            <h3>At Handcrafting with Love</h3>
                            <p>We specialize in creating handcrafted gifts for every occasion, making each moment special since 2019.</p>
                            <p>Our passion for craftsmanship shines through in every piece we create, ensuring that our gifts carry a personal touch. Whether it’s a birthday, anniversary, or just because, we believe that thoughtful, unique gifts can make lasting memories.</p>
                            <button onclick="location.href = '{{route('shop')}}';" type="button" class="btn btn-solid-default mt-2">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Subscribe Section Start -->
    <section class="subscribe-section section-b-space subscribe-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="subscribe-details">
                        <h2 class="mb-3">Subscribe with Your Email!</h2>
                        <h6 class="font-light">Sign up to receive email updates on our special offers, exclusive promotions, and the latest news about our exciting products.</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                    <div class="subscribe-input">
                        <div class="input-group">
                            <input type="email" id="email" class="form-control subscribe-input @error('email') border-red-500 @enderror" placeholder="Your Email Address" required>
                            <button class="btn btn-solid-default" id="subscribe-btn" type="button">Sign in</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Full-screen loading spinner with overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="spinner-border text-white" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

<script>
document.getElementById('subscribe-btn').addEventListener('click', function() {
    // Show the full-screen loading spinner with overlay
    document.getElementById('loading-overlay').classList.remove('hidden');

    // Get the email input value
    const email = document.getElementById('email').value;

    // Send the data using Axios
    axios.post("{{ route('subscribe.store') }}", {
        email: email,
        _token: "{{ csrf_token() }}"
    })
    .then(function(response) {
        swal({
            title: "Success!",
            text: response.data.message,
            icon: "success",
            button: {
                text: "OK",
                className: "bg-blue-500 text-white p-2 px-4 rounded hover:bg-blue-800 transition duration-200",
            },
        }).then(() => {
            location.reload();
        });
    })
    .catch(function(error) {
        let errorMessage = "An error occurred. Please try again later."; 

        if (error.response) {
            if (error.response.status === 422 && error.response.data.errors) {
                const errors = error.response.data.errors;
                errorMessage = errors.email ? errors.email[0] : 'Invalid email address.';
            } else {
                errorMessage = "An unexpected error occurred.";
            }
        }
        
        swal({
            title: "Error!",
            content: {
                element: "div",
                attributes: {
                    innerHTML: `<div class="text-black">${errorMessage}</div>`, 
                },
            },
            icon: "error",
            button: {
                text: "OK",
                className: "bg-blue-500 text-white p-2 px-4 rounded hover:bg-blue-600 transition duration-200",
            },
        });
    })
    .finally(function() {
        // Hide the full-screen loading spinner with overlay once the request is complete
        document.getElementById('loading-overlay').classList.add('hidden');
    });
});
</script>

@endsection
