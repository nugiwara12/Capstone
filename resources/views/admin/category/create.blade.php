<!-- @extends('layouts.app3')

@section('title', 'Create Category')

@section('contents')
    <hr />
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col mb-3" >
                <div class="row mb-3">
                    <input type="text" name="category_name" class="form-control" placeholder="Category" required>
                </div>
                <div class="upload-box large-box w-100" id="categoryBox">
                    <div class="text-center" id="textUpload">
                        <div class="text-primary fs-1"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="text-muted">
                            Upload your <b>Category Image</b>
                            <a href="#" id="categoryUpload">click here to browse</a>
                            <input type="file" id="categoryFileUpload" accept="image/*" name="image" style="display:none;">
                        </div>
                    </div>
                    <button id="deleteImage" style=" display: none; position: absolute; top: 10px; right: 10px; background: red; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">&times;</button>
                            <br>
                            <img id="previewImage" src="" alt="Image Preview" style="display:none; max-width: 100%; margin-top: 10px;">
                </div>
                <div class="row mt-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        window.onload = function() {
            const categoryUploadLink = document.getElementById('categoryUpload');
            const categoryFileUpload = document.getElementById('categoryFileUpload');
            const deleteButton = document.getElementById('deleteImage');
            const previewImage = document.getElementById('previewImage');
            const textUpload = document.getElementById('textUpload');


            categoryUploadLink.addEventListener('click', function(event) {
                event.preventDefault();
                categoryFileUpload.click();
            });

            categoryFileUpload.addEventListener('change', function() {
                const file = categoryFileUpload.files[0];
                if (file) {

                    // Show the selected image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block'; // Show the image
                        textUpload.style.display='none';
                    };
                    reader.readAsDataURL(file);

                    // Show delete button when a file is selected
                    deleteButton.style.display = 'inline-block';
                }
            });

            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();
                categoryFileUpload.value = ''; // Clear the file input
                previewImage.src = ''; // Clear the image preview
                previewImage.style.display = 'none'; // Hide the image
                deleteButton.style.display = 'none'; // Hide the delete button
                textUpload.style.display='block';
            });
        };
    </script>
@endsection -->
