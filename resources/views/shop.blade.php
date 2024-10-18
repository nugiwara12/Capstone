@extends('layouts.app2')

@section('contents')
<section class="site-banner jarallax" id="site-banner" style="background-image: url('{{ asset('assets/images/banner.png') }}');">
    <div class="overlay"></div> <!-- Overlay div -->
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
            <div class="col-lg-3 category-side col-md-4">
                <div class="category-option">
                    <div class="button-close mb-3">
                        <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                    </div>
                    <div class="accordion category-name" id="accordionExample">
                        <div class="accordion-item category-rating">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body category-scroll">
                                    <ul class="category-list">
                                        @foreach ($category as $cat)
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" id="cat_{{ $cat->id }}" name="brands" value="{{ $cat->id }}" type="checkbox">
                                                <label class="form-check-label" for="cat_{{ $cat->id }}">{{ $cat->category_name }}</label>
                                                <p class="font-light">(1)</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Color Selection Accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingColor">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColor" aria-expanded="false" aria-controls="collapseColor">
                                    Color
                                </button>
                            </h2>
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Your existing input fields -->

                                <!-- Hidden input for selected colors -->
                                <input type="hidden" id="selected-colors" name="color" value="">

                                <div id="collapseColor" class="accordion-collapse collapse" aria-labelledby="headingColor" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="relative inline-block text-left">
                                            <div>
                                                <button type="button" class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                    Select a color
                                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.146l3.71-2.936a.75.75 0 111.06 1.12l-4.25 3.25a.75.75 0 01-1.06 0l-4.25-3.25a.75.75 0 010-1.12z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Dropdown -->
                                            <div class="absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1 flex flex-col items-center" role="none"> <!-- Center alignment -->
                                                    @foreach (['red', 'blue', 'green', 'yellow', 'black', 'white', 'purple', 'orange', 'pink'] as $color)
                                                    <a href="#" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200" role="menuitem" data-color="{{ $color }}">
                                                        <span class="w-4 h-4 mr-2 rounded-full bg-{{ $color }}-500"></span> {{ ucfirst($color) }}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="mt-4 btn btn-primary">Submit</button>
                            </form>
                        </div>

                        <!-- Size Selection Accordion -->
                        <div class="accordion-item category-price">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Size
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="category-list">
                                        @foreach (['xs', 'sm', 'md', 'lg', 'xl', 'xxl'] as $size)
                                        <li>
                                            <a href="javascript:void(0)">{{ $size }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Discount Range Accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Discount Range
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="category-list">
                                        @foreach ([5, 10, 20] as $discount)
                                        <li>
                                            <div class="form-check ps-0 custome-form-check">
                                                <input class="checkbox_animated check-it" type="checkbox" id="flexCheckDefault{{ $discount }}">
                                                <label class="form-check-label" for="flexCheckDefault{{ $discount }}">{{ $discount }}% and above</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-product col-lg-9 col-12 ratio_30">
                <div class="row g-4">
                    <!-- label and featured section -->
                    <div class="col-12">
                        <div class="filter-options">
                            <div class="select-options">
                                <div class="dropdown select-featured">
                                    <select class="form-select" name="size" id="pagesize">
                                        <option value="12" selected="">12 Products Per Page</option>
                                        <option value="24">24 Products Per Page</option>
                                        <option value="36">36 Products Per Page</option>
                                        <option value="48">48 Products Per Page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-button">
                                <button type="button" class="btn btn-light">Filter</button>
                            </div>
                        </div>
                    </div>

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
let selectedColors = [];

// Event listener for color selection
document.querySelectorAll('a[role="menuitem"]').forEach(item => {
    item.addEventListener('click', (event) => {
        event.preventDefault();
        const selectedColor = event.target.getAttribute('data-color');
        const button = document.getElementById('menu-button');

        // Check if the color is already selected
        if (selectedColors.includes(selectedColor)) {
            // Remove the color from the selection
            selectedColors = selectedColors.filter(color => color !== selectedColor);
        } else {
            // Add the color to the selection
            selectedColors.push(selectedColor);
        }

        // Update button text and background color
        if (selectedColors.length > 0) {
            button.textContent = selectedColors.join(', ').replace(/(?:^|\s)\S/g, a => a.toUpperCase()); // Capitalize the first letter of each color
            button.style.background = `linear-gradient(135deg, ${selectedColors.map(color => `rgba(${getColorRGB(color)}, 0.5)`).join(', ')})`;

            // Update hidden input with selected colors
            document.getElementById('selected-colors').value = selectedColors.join(',');
        } else {
            button.textContent = 'Select a color'; // Reset text if no colors are selected
            button.style.backgroundColor = ''; // Reset background if no colors are selected
            
            // Clear hidden input
            document.getElementById('selected-colors').value = '';
        }
    });
});

// Function to get RGB values for colors
function getColorRGB(color) {
    switch (color) {
        case 'red': return '255, 0, 0';
        case 'blue': return '0, 0, 255';
        case 'green': return '0, 128, 0';
        case 'yellow': return '255, 255, 0';
        case 'black': return '0, 0, 0';
        case 'white': return '255, 255, 255';
        case 'purple': return '128, 0, 128';
        case 'orange': return '255, 165, 0';
        case 'pink': return '255, 192, 203';
        default: return '255, 255, 255'; // Fallback to white
    }
}
</script>
@endsection
