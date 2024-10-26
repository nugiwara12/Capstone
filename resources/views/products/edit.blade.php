@extends('layouts.app3')

@section('title', 'Edit Product')

@section('contents')
<div class="content-wrapper">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row ">
            <div class="col mb-3" >
                <div class="row mb-3">
                    <label class="form-label"><b>Product Title <span class="text-danger">*</span></b></label>
                    <input type="text" name="title" class="form-control" value="{{$product->title}}">
                </div>
                <div class="row mb-3">
                    <label class="form-label"><b>Product Code <span class="text-danger">*</span></b></label>
                    <input type="number" min="0" name="product_code" class="form-control" value="{{$product->product_code}}">
                </div>
                <div class="row mb-3">
                        <label class="form-label"><b>Product Category <span class="text-danger">*</span></b></label>
                        <select name="category" class="form-select" >
                            <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                                @foreach ($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                        </select>
                </div>
                <div class="row mb-3">
                    <label class="form-label"><b>Product Description <span class="text-danger">*</span></b></label>
                    <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
                </div>
                <div class="row px-10">
                    <div class="col mx-3 mt-3">
                        <div class="form-check">
                            <input type="hidden" name="featured" value="0">
                            <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="featured" value="1" {{ $product->featured ? 'checked' : '' }} >
                            <label class="form-check-label" for="customizableCheckbox">Featured</label>
                        </div>
                        <p class="form-text text-muted">
                            This product will be shown in the "Featured Products"
                        </p>
                    </div>
                    <div class="col mx-3 mt-3">
                        <div class="form-check">
                            <input type="hidden" name="best_seller" value="0">
                            <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="best_seller" value="1" {{ $product->best_seller ? 'checked' : '' }} >
                            <label class="form-check-label" for="customizableCheckbox">Best Seller</label>
                        </div>
                        <p class="form-text text-muted">
                            This product will be shown in the "Best Seller Products"
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label><b>Product Price <span class="text-danger">*</span></b></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">&#8369;</span>
                            <input type="text" name="price" min="0" class="form-control" value="{{$product->price}}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>
                    <div class="col">
                        <label><b>Product Quantity <span class="text-danger">*</span></b></label>
                        <input type="number" name="quantity" min="0" class="form-control" value="{{$product->quantity}}">
                    </div>
                </div>
            </div>
            <div class="col px-10">
                <div class="col">
                    <label class="form-label"><b>Product Images <span class="text-danger">*</span></b></label>
                        <div class="row-md-6 mb-3">
                            <div id="currentImage"><p>Current Image </p>
                                <img id="current-image-preview" src="{{ asset('images/' . $product->main_image) }}" alt="Image Preview" >
                            </div>
                            <div class="upload-box large-box w-100" id="largeBox" >
                                <div class="text-center" id="textUpload">
                                    <div class="text-primary fs-1"><i class="bi bi-cloud-arrow-up"></i></div>
                                    <div class="text-muted">
                                        Change the <b>Main Product Image</b> <a href=javascript:void(0) id="upload-link-1">click here to browse</a>
                                        <input type="file" id="file-upload-1" accept="image/*" name="main_image" >
                                    </div>
                                </div>
                            </div>
                            <div id="mainImagePreview">
                                <button id="delete-button">&times;</button>
                                <img id="image-preview" src="" alt="Image Preview" >
                            </div>

                        </div>
                        <div class="row-md-2">
                            <div class="upload-box small-box w-100" id="imageGallery">
                                <div class="text-center small">
                                    <div class="text-primary fs-3"><i class="bi bi-cloud-arrow-up"></i></div>
                                    <div class="text-muted">
                                        Upload your images here for <b>Product Gallery</b> <a href=javascript:void(0) id="upload-link-2">click to browse</a>
                                        <input type="file" id="file-upload-2" accept="image/*" multiple name="img_gallery[]">
                                    </div>
                                </div>
                            </div>
                            <div id="image-gallery" ></div>
                        </div>
                </div>
                <div class="col mt-3">
                    <div class="form-check form-switch">
                        <input type="hidden" name="customizable" value="0">
                        <input class="form-check-input" type="checkbox" id="customizableCheckbox" name="customizable" value="1" {{ $product->customizable ? 'checked' : '' }} onchange="togglePrintingArea(this)">
                        <label class="form-check-label" for="customizableCheckbox">Product Customizable</label>
                    </div>
                    <p class="form-text text-muted">
                        Enabling this option will allow customers to customize the product by adding images or text to the printing area.
                    </p>
                </div>


                <div id="printingArea" >
                    <div class="row mt-3" >
                        <label class="form-label"><b>Printing Area</b></label>
                    </div>
                    <div class="upload-box large-box w-100" @if ($product->customizable == 0)
                        id="customizeBox"
                        @else
                        style="display:none;"
                    @endif >
                        <div class="text-center">
                            <div class="text-primary fs-1"><i class="bi bi-cloud-arrow-up"></i></div>
                            <div class="text-muted">
                                Upload your <b>Customize Product Image</b> <a href=javascript:void(0) id="browseLink">click here to browse</a>
                                <input class="form-control w-100" type="file" id="fileInput" name="customizingImage" required accept="image/*" onchange="handleFileUpload(this)" disabled >
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3" >
                        <div class="row" @if ($product->customizable == 0)
                            id="customizeImagePreview"
                            @else
                            style="display:block;"
                        @endif  >
                            <p>Image Preview</p>
                            <div class="canvasContainer p-0 form-control" id="canvasContainer" style="display: flex; align-items:center; justify-content:center;" >
                                <img id="preview2" src="{{ asset('images/' . $product->customizing_image) }}" alt="Image Preview" style="display: block; max-width: 100%; max-height: 100%; border-radius: 10px;">
                                <canvas id="canvas" class="canvas" style="position: absolute; display: block; height: {{ $product->customizable == 1 ? $product->canvas_height : 86 }}%; width: {{ $product->customizable == 1 ? $product->canvas_width : 60 }}%; top:{{ $product->customizable == 1 ? $product->canvas_top : 6 }}%; left: {{ $product->customizable == 1 ? $product->canvas_left : 21 }}%; border: dotted dimgray;"></canvas>
                                <button id="deleteCustomizeImage" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">×</button>
                            </div>
                        </div>
                        <div class="row w-100 mt-3">
                            <div class="col">
                                <label>Width (%)</label>
                                <input type="number" id="widthInput" value="{{ $product->customizable == 1 ? $product->canvas_width : 60 }}" min="0" max="100" class="form-control mb-3" name="customization_width" placeholder="" {{ $product->customizable == 1 ? '' : 'disabled' }} >
                            </div>
                            <div class="col">
                                <label>Height (%)</label>
                                <input type="number" id="heightInput" value="{{ $product->customizable == 1 ? $product->canvas_height : 86 }}" min="0" max="100" class="form-control mb-3" name="customization_height" {{ $product->customizable == 1 ? '' : 'disabled' }} >
                            </div>
                            <div class="col">
                                <label>Top (%)</label>
                                <input type="number" id="topInput" value="{{ $product->customizable == 1 ? $product->canvas_top : 6 }}" min="0" max="100" class="form-control mb-3" name="customization_top" {{ $product->customizable == 1 ? '' : 'disabled' }} >
                            </div>
                            <div class="col">
                                <label>Left (%)</label>
                                <input type="number" id="leftInput" value="{{ $product->customizable == 1 ? $product->canvas_left : 21 }}" min="0" max="100" class="form-control mb-3" name="customization_left" {{ $product->customizable == 1 ? '' : 'disabled' }} >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-6 ms-auto d-grid"> <!-- col-6 makes it half-width; ms-auto pushes it to the right -->
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>

    </form>
@endsection
