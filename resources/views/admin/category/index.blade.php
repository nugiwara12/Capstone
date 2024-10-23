@extends('layouts.app3')

@section('contents')
<div class="w-full">
    <div class="min-h-full mt-4">
        <!-- Success Message -->
        <x-category.add-category />
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-black uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-black uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                    @forelse ($categories as $category)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">{{ $category->category_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-right relative">
                            <div class="flex justify-end space-x-2">
                                <!-- <a href="javascript:void(0)" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white hover:bg-blue-500 focus:outline-none" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a> -->
                                <form id="deleteForm{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500" onclick="confirmDelete('{{ $category->id }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-center">No categories found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Show Entries Form -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="flex items-center mb-2 md:mb-0">
            <form method="GET" action="{{ route('category') }}" class="flex items-center">
                <label for="per_page" class="mr-2 text-sm mt-2">Show</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            <span class="text-sm ml-2">of <strong>{{ $categories->total() }}</strong> entries</span>
        </div>

        <!-- Pagination Section -->
        <div class="md:mt-0">
            <x-category.pagination :categories="$categories" />
        </div>
    </div>
</div>

@foreach ($categories as $category)
    @include('components.category.edit-category', ['category' => $category])
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/58y5KZJ1G2Rn0ILU35h/Xo/2H45Ebg9hcz8Z7e" crossorigin="anonymous"></script>
<script>
// $(document).ready(function() {
//     // Handle edit category form submission
//     $(`form[id^="editCategoryForm"]`).on('submit', function(e) {
//         e.preventDefault(); // Prevent the default form submission

//         var categoryId = $(this).data('category-id'); // Get the category ID from the form's data attribute
//         var formData = new FormData(this); // Create FormData object from the form

//         $.ajax({
//             url: `/category/${categoryId}`, // Target the correct URL for the update
//             type: "PUT", // Use the correct HTTP method
//             data: formData, // Pass the form data
//             contentType: false,
//             processData: false,
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
//             },
//             success: function(response) {
//                 Swal.fire({
//                     title: 'Success!',
//                     text: 'Category updated successfully.',
//                     icon: 'success',
//                     confirmButtonText: 'OK'
//                 }).then(() => {
//                     location.reload(); // Reload the page after successful update
//                 });
//             },
//             error: function(xhr) {
//                 Swal.fire({
//                     title: 'Error!',
//                     text: 'Failed to update category: ' + (xhr.responseJSON.message || 'Unknown error'),
//                     icon: 'error',
//                     confirmButtonText: 'Try Again'
//                 });
//             }
//         });
//     });

//     // Attach preview function to the file input
//     $('input[type="file"]').on('change', function(event) {
//         previewImage(event, `previewImage${$(this).data('category-id')}`);
//     });
// });

// Confirm delete action
function confirmDelete(categoryId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById(`deleteForm${categoryId}`);
            $.ajax({
                url: form.action,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'The category has been deleted.', 'success').then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'There was a problem deleting the category.', 'error');
                }
            });
        }
    });
}
</script>
@endsection
