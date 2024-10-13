@extends('layouts.app2')

@section('contents')

    <section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
    <div class="overlay"></div> <!-- Overlay div -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                <h1 class="page-title">About Us</h1>
                <div class="breadcrumbs">
                    <span class="item">
                        <a href="{{route('home')}}">Home /</a>
                    </span>
                    <span class="item">About</span>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- team leader section Start -->
    <section class="overflow-hidden" style="margin-bottom: 50px;" >
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-5 offset-xl-1">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <img src="assets/images/about_1.png"
                                class="img-fluid rounded-3 about-image" alt="">
                        </div>
                        <div class="col-md-6">
                            <img src="assets/images/about_2.png"
                                class="img-fluid rounded-3 about-image" alt="">
                        </div>
                        <div class="col-12 ratio_40">
                            <div>
                                <img src="assets/images/about_3.png"
                                    class="img-fluid rounded-3 team-image bg-img" alt="">
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
                            <p>Our passion for craftsmanship shines through in every piece we create, ensuring that our gifts carry a personal touch. Whether it’s a birthday, anniversary, or just because, we believe that thoughtful, unique gifts can make lasting memories.

                            </p>
                            <button onclick="location.href = '{{route('shop')}}';" type="button" class="btn btn-solid-default">Shop Now</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team leader section End -->
    <!-- Subscribe Section Start -->
    <section class="subscribe-section section-b-space subscribe-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="subscribe-details">
                        <h2 class="mb-3">Sign up for Newsletters!</h2>
                        <h6 class="font-light">SGet e-mail updates about our special offers and receive our
                            newsletters to stay informed about our fresh and exciting products.</h6>
                    </div>
                </div>

                    <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                        <div class="subsribe-input">
                            <div class="input-group">
                                <input type="text" class="form-control subscribe-input" placeholder="Your Email Address">
                                <button class="btn btn-solid-default" type="button">Sign in</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
