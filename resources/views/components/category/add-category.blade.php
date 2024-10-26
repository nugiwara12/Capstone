<div class="border-b bg-gray-50 rounded-lg bg-gray-100 py-2">
    <div class="flex justify-between items-center">
        <!-- Search Form -->
        <div class="mb-2 w-full md:w-auto">
            <form method="GET" action="{{ route('category') }}" class="relative w-full flex items-center">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="bi bi-tag text-gray-500"></i>
                </div>
                <input type="search" id="search" name="search"
                    class="block w-full pl-10 pr-5 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm transition duration-150 ease-in-out hover:border-blue-400"
                    placeholder="SEARCH" />
                <button type="submit" class="absolute right-0 top-0 mt-2 mr-4">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <div class="flex justify-end mb-2">
            <!-- Button to open the Add Users modal -->
            <button class="bg-blue-700 p-2 rounded-md text-white hover:text-white" id="openAddModalButton">
                <i class="bi bi-journal-plus"></i> Add Category
            </button>
        </div>
    </div>
</div>

<!-- Add Users Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0" id="addModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="text-lg font-bold" id="addModalLabel">Register Category</h5>
            <button type="button" class="text-2xl text-gray-500 hover:text-gray-700" id="closeAddModalButton">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="p-2 overflow-auto">
            <form id="userRegistrationForm" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="text" name="category_name" class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Category" required>
                </div>
                <div class="upload-box w-full text-center border border-dashed border-gray-400 rounded-lg p-4 relative">
                    <div class="text-primary fs-1 mb-2">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div class="text-muted">
                        Upload your <b>Category Image</b>
                        <a href="#" id="categoryUpload" class="text-blue-500 hover:underline">click here to browse</a>
                        <input type="file" id="categoryFileUpload" accept="image/*" name="image" style="display:none;">
                    </div>
                    <button id="deleteImage" class="hidden absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center" title="Remove Image">&times;</button>
                    <img id="previewImage" src="" alt="Image Preview" class="hidden max-w-full mt-4 rounded-md object-cover h-40 w-full"> <!-- Fit image in container -->
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    // Ensure modal is hidden on page load
    $('#addModal').addClass('hidden');
    $('#addModalContent').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');

    // CSRF token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Users modal open/close
    $('#openAddModalButton').on('click', function() {
        $('#addModal').removeClass('hidden');
        $('#addModalContent').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
    });

    $('#closeAddModalButton').on('click', function() {
        $('#addModalContent').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function() {
            $('#addModal').addClass('hidden');
        }, 300); // Match the timeout with the duration of the fade effect
    });

    // Handle file upload preview
    $('#categoryUpload').on('click', function() {
        $('#categoryFileUpload').click();
    });

    $('#categoryFileUpload').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result).show();
                $('#deleteImage').show(); // Show delete button when an image is selected
            }
            reader.readAsDataURL(file);
        }
    });

    // Delete image functionality
    $('#deleteImage').on('click', function() {
        $('#categoryFileUpload').val(''); // Clear the input
        $('#previewImage').hide(); // Hide the preview image
        $(this).hide(); // Hide the delete button
    });

    // Submit form via AJAX
    $('#userRegistrationForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Use FormData for handling file uploads
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('category.store') }}", // Your Laravel route for storing categories
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Category registered successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#addModalContent').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                    setTimeout(function() {
                        $('#addModal').addClass('hidden'); // Close the modal
                        $('#userRegistrationForm')[0].reset(); // Reset the form
                        $('#previewImage').hide(); // Reset the image preview
                        $('#deleteImage').hide(); // Hide the delete button
                        window.location.reload(); // Reload the page after the modal closes
                    }, 300); // Match the timeout with the duration of the fade effect
                });
            },
            error: function(xhr) {
                var errorMessage = 'Registration failed. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        });
    });
});
</script>
@endsection
