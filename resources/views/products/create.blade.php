@extends('layouts.app3')

@section('title', 'Create Product')

@section('contents')
<div class="content-wrapper">
    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<hr class="my-4 border-gray-200" />

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="mb-4">
                <label class="block font-bold">Product Title <span class="text-red-600">*</span></label>
                <input type="text" name="title" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Product Title" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Product Code <span class="text-red-600">*</span></label>
                <input type="number" min="0" name="product_code" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Product Code" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Product Category <span class="text-red-600">*</span></label>
                <select name="category" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="" selected>Choose Category</option>
                    @foreach ($category as $category)
                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Product Description <span class="text-red-600">*</span></label>
                <textarea class="w-full p-2 border border-gray-300 rounded" name="description" placeholder="Description" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <div class="flex items-start">
                        <input type="hidden" name="featured" value="0">
                        <input class="mr-2" type="checkbox" id="featuredCheckbox" name="featured" value="1">
                        <label for="featuredCheckbox" class="font-bold">Featured</label>
                    </div>
                    <p class="text-gray-500">This product will be shown in the "Featured Products"</p>
                </div>
                <div class="mb-4">
                    <div class="flex items-start">
                        <input type="hidden" name="best_seller" value="0">
                        <input class="mr-2" type="checkbox" id="bestSellerCheckbox" name="best_seller" value="1">
                        <label for="bestSellerCheckbox" class="font-bold">Best Seller</label>
                    </div>
                    <p class="text-gray-500">This product will be shown in the "Best Seller Products"</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="font-bold">Product Price <span class="text-red-600">*</span></label>
                    <div class="flex items-center">
                        <span class="px-2 bg-gray-100 border border-gray-300 rounded-l">₱</span>
                        <input type="text" name="price" class="w-full p-2 border border-gray-300 rounded-r" placeholder="Enter Product Price" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="font-bold">Product Quantity <span class="text-red-600">*</span></label>
                    <input type="number" name="quantity" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Product Quantity" required>
                </div>
            </div>
        </div>

        <div>
            <div class="mb-4">
                <label class="font-bold">Product Images <span class="text-red-600">*</span></label>
                <div class="w-full border border-dashed border-gray-400 rounded p-4 text-center">
                    <div class="text-primary text-4xl"><i class="bi bi-cloud-arrow-up"></i></div>
                    <p class="text-gray-500">Upload your <b>Main Product Image</b> <a href="javascript:void(0)" class="text-blue-500 underline" id="upload-link-1">click here to browse</a></p>
                    <input type="file" id="file-upload-1" class="hidden" accept="image/*" name="main_image">
                </div>
                <div id="mainImagePreview" class="mt-4 hidden">
                    <button id="delete-button" class="text-red-500">&times;</button>
                    <img id="image-preview" src="" alt="Image Preview" class="w-full h-auto rounded">
                </div>
            </div>

            <div class="mb-4">
                <label class="font-bold">Product Gallery</label>
                <div class="w-full border border-dashed border-gray-400 rounded p-4 text-center">
                    <div class="text-primary text-3xl"><i class="bi bi-cloud-arrow-up"></i></div>
                    <p class="text-gray-500">Upload your images here for <b>Product Gallery</b> <a href="javascript:void(0)" class="text-blue-500 underline" id="upload-link-2">click here to browse</a></p>
                    <input type="file" id="file-upload-2" class="hidden" accept="image/*" multiple name="img_gallery[]">
                </div>
                <div id="image-gallery" class="grid grid-cols-2 gap-4 mt-4"></div>
            </div>

            <div class="mb-4">
                <div class="flex items-start">
                    <input type="hidden" name="customizable" value="0">
                    <input class="mr-2" type="checkbox" id="customizableCheckbox" name="customizable" value="1" onchange="togglePrintingArea(this)">
                    <label for="customizableCheckbox" class="font-bold">Product Customizable</label>
                </div>
                <p class="text-gray-500">Enabling this option will allow customers to customize the product by adding images or text to the printing area.</p>
            </div>

            <div id="printingArea" class="hidden">
                <label class="font-bold">Printing Area</label>
                <div class="w-full border border-dashed border-gray-400 rounded p-4 text-center">
                    <div class="text-primary text-4xl"><i class="bi bi-cloud-arrow-up"></i></div>
                    <p class="text-gray-500">Upload your <b>Customize Product Image</b> <a href="javascript:void(0)" class="text-blue-500 underline" id="browseLink">click here to browse</a></p>
                    <input type="file" id="fileInput" class="hidden" name="customizingImage" accept="image/*" onchange="handleFileUpload(this)" disabled>
                </div>
                <div class="mt-4" id="customizeImagePreview">
                    <p>Image Preview</p>
                    <div class="border rounded p-2">
                        <img id="preview2" src="" alt="Image Preview" class="w-full h-auto">
                        <canvas id="canvas" class="hidden"></canvas>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mt-4">
                    <div>
                        <label>Width (%)</label>
                        <input type="number" id="widthInput" value="60" min="0" max="100" class="w-full p-2 border border-gray-300 rounded" name="customization_width" disabled>
                    </div>
                    <div>
                        <label>Height (%)</label>
                        <input type="number" id="heightInput" value="86" min="0" max="100" class="w-full p-2 border border-gray-300 rounded" name="customization_height" disabled>
                    </div>
                    <div>
                        <label>Top (%)</label>
                        <input type="number" id="topInput" value="6" min="0" max="100" class="w-full p-2 border border-gray-300 rounded" name="customization_top" disabled>
                    </div>
                    <div>
                        <label>Left (%)</label>
                        <input type="number" id="leftInput" value="21" min="0" max="100" class="w-full p-2 border border-gray-300 rounded" name="customization_left" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="w-full p-3 bg-green-600 text-white rounded hover:bg-green-700">Submit</button>
    </div>
</form>
@endsection
