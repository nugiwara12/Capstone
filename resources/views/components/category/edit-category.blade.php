<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close text-2xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm{{ $category->id }}" data-category-id="{{ $category->id }}" class="space-y-2" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Name</label>
                            <input type="text" name="category_name" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Category Name" value="{{ $category->category_name }}" required>
                            @error('category_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-muted">
                            <div class="col-span-1 md:col-span-2">
                                <div class="flex flex-col items-center justify-center w-full">
                                    <!-- Existing Image Preview -->
                                    @if($category->image)
                                        <img id="currentImage{{ $category->id }}" src="{{ asset('images/' . $category->image) }}" alt="Current Image" class="h-44 w-full object-cover mb-2 rounded-lg" />
                                    @endif
                                    <label for="dropzone-file-categoryId{{ $category->id }}" class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-5 h-5 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 md:text-center sm:text-center lg:text-center">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                        </div>
                                        <!-- Image Preview -->
                                        <img id="previewImage{{ $category->id }}" src="" alt="Preview" class="hidden h-44 w-full object-cover mb-2 rounded-lg" />
                                    </label>
                                    <!-- Hidden file input for image upload -->
                                    <input type="file" id="dropzone-file-categoryId{{ $category->id }}" name="image" class="hidden" data-category-id="{{ $category->id }}" onchange="previewImage(event, 'previewImage{{ $category->id }}')"/>
                                </div>
                                <span id="categoryIdError" class="text-red-500 mt-1 text-sm"></span>
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <button type="button" id="category-id{{ $category->id }}" class="mt-5 w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview function
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    const currentImage = document.getElementById(`currentImage${event.target.dataset.categoryId}`);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result; // Set the image source
            preview.classList.remove('hidden'); // Show the new image
            currentImage.classList.add('hidden'); // Hide the existing image
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        currentImage.classList.remove('hidden'); // Show the existing image if no new file
    }
}
