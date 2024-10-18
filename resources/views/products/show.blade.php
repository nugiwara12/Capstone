@extends('layouts.app3')

@section('title', 'Show Product')

@section('contents')
    <hr />
    <div class="row ">
        <div class="col mb-3" >
            <div class="row mb-3">
                <label class="form-label"><b>Product Title</b></label>
                <input type="text" name="title" class="form-control" value="{{$product->title}}" readonly>
            </div>
            <div class="row mb-3">
                <label class="form-label"><b>Product Code </b></label>
                <input type="number" min="0" name="product_code" class="form-control" value="{{$product->product_code}}" readonly>
            </div>
            <div class="row mb-3">
                <label class="form-label"><b>Product Category </b></label>
                    <select name="category" class="form-select" disabled>
                        <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                            @foreach ($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                    </select>
            </div>
            <div class="row mb-3">
                <label class="form-label"><b>Product Description </b></label>
                <textarea class="form-control" id="description" name="description" value="" readonly>{{$product->description}}</textarea>
            </div>
            <div class="row px-10">
                <div class="col mx-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="featured" value="1" {{ $product->featured ? 'checked' : '' }} disabled >
                        <label class="form-check-label" for="customizableCheckbox">Featured</label>
                    </div>
                    <p class="form-text text-muted">
                        This product will be shown in the "Featured Products"
                    </p>
                </div>
                <div class="col mx-3 mt-3">
                    <div class="form-check">
                        <input type="hidden" name="best_seller" value="0">
                        <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="best_seller" value="1" {{ $product->best_seller ? 'checked' : '' }} disabled >
                        <label class="form-check-label" for="customizableCheckbox">Best Seller</label>
                    </div>
                    <p class="form-text text-muted">
                        This product will be shown in the "Best Seller Products"
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label><b>Product Price </b></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">&#8369;</span>
                        <input type="number" name="price" min="0" class="form-control" value="{{$product->price}}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label><b>Product Quantity </b></label>
                    <input type="number" name="quantity" min="0" class="form-control" value="{{$product->quantity}}" readonly>
                </div>
            </div>
        </div>
        <div class="col px-10">
            <div class="col">
                <label class="form-label"><b>Product Images </b></label>
                <div class="row-md-6 mb-3">
                    <label>Main Image</label>
                    <div id="showMainImagePreview" >
                        <img id="image-preview" src="{{ asset('images/' . $product->main_image) }}" alt="Image Preview" style="display: block;">
                    </div>
                </div>
                    <div class="row-md-2">
                        <label>Image Gallery</label>
                        <div id="show-image-gallery" >
                            @if(is_array($product->img_gallery) || is_object($product->img_gallery))
                            @foreach ($product->img_gallery as $img)
                                <img id="galleryImagePreview" src="{{ asset('images/' . $img) }}" alt="Image Preview" style="display: block;">
                            @endforeach
                            @else
                                <p>No images available.</p>
                            @endif
                        </div>
                    </div>
            </div>
            <div class="col mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="customizable" value="1" {{ $product->customizable ? 'checked' : '' }}  onchange="togglePrintingArea(this)" disabled>
                    <label class="form-check-label" for="customizableCheckbox">Product Customizable</label>
                </div>
                <p class="form-text text-muted">
                    Enabling this option will allow customers to customize the product by adding images or text to the printing area.
                </p>
            </div>

            @if ($product->customizable == 1)
                <div id="showPrintingArea">
                    <div class="row mt-3">
                        <label class="form-label"><b>Printing Area</b></label>
                    </div>
                    <div class="col mb-3">
                        <div class="row" id="showCustomizeImagePreview" style="display: block;">
                            <p>Image Preview</p>
                            <div class="canvasContainer p-0 form-control" id="canvasContainer" style="display: flex; align-items:center; justify-content:center;" >
                                <img id="preview2" src="{{ asset('images/' . $product->customizing_image) }}" alt="Image Preview" style="display: block;">
                                <canvas class="canvas" style="display: block; position: absolute; height: {{$product->canvas_height}}%; width: {{$product->canvas_width}}%; top: {{$product->canvas_top}}%; left: {{$product->canvas_left}}%; border: dotted dimgray;"></canvas>
                            </div>
                        </div>
                        <div class="row w-100 mt-3">
                            <div class="col">
                                <label>Width (%)</label>
                                <input type="number" id="widthInput" value="{{$product->canvas_width}}" min="0" max="100" class="form-control mb-3" name="customization_width" disabled>
                            </div>
                            <div class="col">
                                <label>Height (%)</label>
                                <input type="number" id="heightInput" value="{{$product->canvas_height}}" min="0" max="100" class="form-control mb-3" name="customization_height" disabled>
                            </div>
                            <div class="col">
                                <label>Top (%)</label>
                                <input type="number" id="topInput" value="{{$product->canvas_top}}" min="0" max="100" class="form-control mb-3" name="customization_top" disabled>
                            </div>
                            <div class="col">
                                <label>Left (%)</label>
                                <input type="number" id="leftInput" value="{{$product->canvas_left}}" min="0" max="100" class="form-control mb-3" name="customization_left" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
