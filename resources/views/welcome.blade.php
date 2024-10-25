@extends('layouts.app2')

@section('contents')

 <!-- CTA -->
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div id="slideshow" class="position-relative">
                <div class="slide active">
                    <div class="lightblue-box">
                        <div class="slide-text">
                        <img src="assets/images/img1.png" alt="FIRST IMAGE" class="box1-image">
                    </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="lightblue-box"><img src="assets/images/first-promo.png" alt="SECOND IMAGE" class="box1-image"></div>
                </div>
                <div class="slide">
                    <div class="lightblue-box"><img src="assets/images/second-promo.png" alt="THIRD IMAGE" class="box1-image"></div>
                </div>
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)" style="font-size:30px; position: absolute; left: 10px; top: 50%; color: #61d1c7;">&#10094;</a>
                <a class="next" onclick="plusSlides(1)" style="font-size:30px; position: absolute; right: 10px; top: 50%; color: #61d1c7;">&#10095;</a>
                <div class="dot-container">
                    <div class="dot" onclick="currentSlide(1)"></div>
                    <div class="dot" onclick="currentSlide(2)"></div>
                    <div class="dot" onclick="currentSlide(3)"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex"> <!-- Use flex for horizontal alignment -->
            <div class="d-flex flex-column"> <!-- Create a column for promo images -->
                <div class="lightblue-box1 mb-2"><img src="{{asset('assets/images/promos/4.png')}}" alt="FIRST PROMO" class="box1-image"></div>
                <div class="lightblue-box2 mb-2"><img src="{{asset('assets/images/promos/5.png')}}" alt="SECOND PROMO" class="box1-image"></div>
            </div>
        </div>
    </div>
</div>
<!-- End of CTA -->


<!-- Welcome -->
<div class="container text-center mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12 box_2 p-4" style="background-color: #F7FBFD;">
            <div class="text-row-1">
                <h1 class="mb-3" style="font-family: 'Cantora One', cursive; font-size: 36px;">Welcome!</h1>
            </div>
            <div class="text-row-2 mb-3" style="color: #000; font-size: 20px; font-family: 'Cambay', sans-serif;">
                Explore our collection of unique, handcrafted gifts made with love. Find something special <br>
                today and make every moment unforgettable! Happy shopping!
            </div>
            <div class="button-row1">
                <a href="{{route('shop')}}" class="btn btn-custom">Shop Now</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Welcome -->

<!-- banner section start -->
<section class="ratio2_1 banner-style-2">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="collection-banner p-bottom p-center text-center">
                    <a href="#" class="banner-img">
                        <img src="{{asset('assets/images/3-categories/FORHIM.png')}}" class="bg-img blur-up lazyload" alt="">
                    </a>
                    <div class="banner-detail">
                        <span class="font-dark-30">Buy <span>Now!</span></span>
                    </div>
                    <a href="javascript:void(0);" class="contain-banner">
                        <div class="banner-content with-big">
                            <h2 class="mb-2">For Him</h2>
                            <span>Surprise him with a personalized treasure.
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="collection-banner p-bottom p-center text-center">
                    <a href="javascript:void(0);" class="banner-img">
                        <img src="{{asset('assets/images/3-categories/FORHER.png')}}" class="bg-img blur-up lazyload" alt="">
                    </a>
                    <div class="banner-detail">
                        <span class="font-dark-30">Buy <span>Now!</span></span>
                    </div>
                    <a href="javascript:void(0);" class="contain-banner">
                        <div class="banner-content with-big">
                            <h2 class="mb-2">For Her</h2>
                            <span>Delight her with a one-of-a-kind creation.</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="collection-banner p-bottom p-center text-center">
                    <a href="javascript:void(0);" class="banner-img">
                        <img src="{{asset('assets/images/3-categories/spo.png')}}" class="bg-img blur-up lazyload" alt="">
                    </a>
                    <div class="banner-detail">
                        <span class="font-dark-30">Buy <span>Now!</span></span>
                    </div>
                    <a href="javascript:void(0);" class="contain-banner">
                        <div class="banner-content with-big">
                            <h2 class="mb-2">Special Occasions</h2>
                            <span>Get the perfect gift for any celebration.</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- Featured Products -->
<section class="ratio_asos overflow-hidden">
    <div class="container p-sm-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="title-3 text-center">
                    <h2>Featured Products</h2>
                    <h5 class="theme-color">Our Collection</h5>
                </div>
            </div>
        </div>
        <div class="row g-sm-4 g-3">
            @foreach ($featured as $item)
            <div class="col-xl-2 col-lg-2 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <a href="{{route('product-details', $item->id)}}">
                            <img src="{{ asset('images/' . $item->main_image) }}" class="w-100 bg-img blur-up lazyload" alt="{{$item->title}}">
                        </a>
                        <!-- <div class="circle-shape"></div> -->
                        <span class="background-text">{{$item->category}}</span>
                        <div class="cart-wrap">
                            <ul>
                                {{-- <li><input type="number"></li> --}}
                                {{-- <li><a href="{{route('cart')}}" class="addtocart-btn"><i data-feather="shopping-cart"></i></a></li> --}}
                                <!-- <li><a href="{{route('product-details', $item->id)}}"><i data-feather="eye"></i></a></li> -->
                                {{-- <li><a href="javascript:void(0)" class="wishlist"><i data-feather="heart"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="product-style-3 product-style-chair">
                        <div class="product-title d-block mb-0">
                            <div class="r-price">
                                <div class="theme-color">&#8369;{{$item->price}}</div>
                            </div>
                            <p class="font-light mb-sm-2 mb-0">{{$item->category}}</p>
                            <a href="#" class="font-default">
                                <h5>{{$item->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End of Featured Products -->

<!-- category section start -->
<section class="category-section ratio_40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="title title-2 text-center">
                    <h2>Our Category</h2>
                    <h5 class="text-color">Our collection</h5>
                </div>
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-xxl-2 col-lg-3">
                <div class="category-wrap category-padding category-block theme-bg-color">
                    <div>
                        <h2 class="light-text">Top</h2>
                        <h2 class="top-spacing">Our Top</h2>
                        <span>Categories</span>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-lg-9">
                <div class="category-wrapper category-slider1 white-arrow category-arrow">
                    @foreach ($category as $cat)
                    <div>
                        <a href="{{route('shop')}}" class="category-wrap category-padding">
                            <img src="{{ asset('images/' . $cat->image) }}" class="bg-img blur-up lazyload"
                                alt="category image">
                            <div class="category-content category-text-1">
                                <h3 class="theme-color">{{$cat->category_name}}</h3>
                                {{-- <span class="text-dark">Fashion</span> --}}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- category section end -->

<!----- About ---->
<section id="billboard">
    <div class="container">
        <div class="main-slider pattern-overlay">
            <div class="slider-item flex">
                <!-- Background text -->
                <span class="background-text">Handcraft</span>

                <!-- Text Section on the Left -->
                <div class="banner-content md:w-1/2 flex flex-col justify-center">
                    <h2 class="banner-title">We are Gawang Gamat</h2>
                    <p>Your gateway to locally crafted treasures. Specializing in handcrafted, one-of-a-kind products, offering a wide range of unique items made with love and care. Bring beautifully crafted, customizable products to your home and discover the charm of handmade items, and create something truly special with us!</p>
                    <div class="btn-wrap">
                        <a href="#" class="btn btn-outline-warning">
                            Read More
                            <i class="bi bi-arrow-right"></i> <!-- Bootstrap icon -->
                        </a>

                    </div>
                </div>

                <!-- Image Section on the Right -->
                <div class="banner-image md:w-1/2 flex justify-center items-center">
                    <img src="assets/images/doll.png" alt="Life of the Wild" class="rounded-lg" style="width: 80%; height: auto; max-height: 350px;">
                </div>
            </div>
        </div>
    </div>
</section>
<!-----End of about ---->

<!-- Best Seller -->
<section class="ratio_asos overflow-hidden pb-5">
    <div class="px-0 container-fluid p-sm-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="title-3 text-center">
                    <h2>Best Selling Products</h2>
                    <h5 class="theme-color">Our Collection</h5>
                </div>
            </div>

            <div class="our-product products-c">
                <!-- foreach -->
            @foreach ($best_seller as $best)
            <div class="col-xl-2 col-lg-2 col-6">
                <div class="product-box">
                    <div class="img-wrapper">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('images/' . $best->main_image) }}" class="w-100 bg-img blur-up lazyload" alt="{{$best->title}}">
                        </a>
                        <div class="circle-shape"></div>
                        <span class="background-text">{{$best->category}}</span>
                        <div class="cart-wrap">
                            <ul>
                               <!-- add to cart -->
                            </ul>
                        </div>
                    </div>
                    <div class="product-style-3 product-style-chair">
                        <div class="product-title d-block mb-0">
                            <div class="r-price">
                                <div class="theme-color">&#8369;{{$best->price}}</div>
                            </div>
                            <p class="font-light mb-sm-2 mb-0">{{$best->category}}</p>
                            <a href="#" class="font-default">
                                <h5>{{$best->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
                <!-- endforeach -->
            </div>
        </div>
    </div>
</section>
<!-- End of Best Seller -->

<div id="qvmodal"></div>

<script>
window.embeddedChatbotConfig = {
chatbotId: "aTOnjV18qrgbe58oKPKFA",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="aTOnjV18qrgbe58oKPKFA"
domain="www.chatbase.co"
defer>
</script>

@endsection
