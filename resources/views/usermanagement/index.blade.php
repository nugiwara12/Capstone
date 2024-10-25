@extends('layouts.app3')

@section('contents')
<div class="w-full">
    <x-card.usermanagement />
    <div class="min-h-full mt-4">
        <!-- Success Message -->
        <x-modals.usermanagement.add-user />
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                    @forelse ($users as $user)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black">{{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-left relative">
                            <div class="flex items-center space-x-2">
                                <a href="javascript:void(0)" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white hover:bg-blue-500 focus:outline-none" data-toggle="modal" data-target="#editUserModal{{ $user->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form id="deleteForm{{ $user->id }}" action="{{ route('usermanagement.destroy', $user->id) }}" method="POST" class="block delete-form" role="menuitem">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500 focus:outline-none" onclick="confirmDelete('{{ $user->id }}')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Show Entries Form -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="flex items-center mb-2 md:mb-0">
            <form method="GET" action="{{ route('usermanagement') }}" class="flex items-center">
                <label for="per_page" class="mr-2 text-sm mt-2">Show</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            <span class="text-sm ml-2">of <strong>{{ $users->total() }}</strong> entries</span>
        </div>

        <!-- Pagination Section -->
        <div class="md:mt-0">
            <x-pagination :users="$users" />
        </div>
    </div>
</div>

@foreach ($users as $user)
    @include('components.modals.usermanagement.edit-user', ['user' => $user])
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/58y5KZJ1G2Rn0ILU35h/Xo/2H45Ebg9hcz8Z7e" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Handle dropdown toggle
$(document).ready(function() {
    $('[id^="dropdownMenuButton"]').on('click', function(event) {
        event.stopPropagation(); // Prevent event from bubbling up
        const dropdownMenu = $(this).next('.dropdown-menu');

        // Toggle the dropdown menu
        dropdownMenu.toggleClass('hidden');

        // Close other dropdowns if needed
        $('.dropdown-menu').not(dropdownMenu).addClass('hidden');
    });

    // Close the dropdown if clicking outside
    $(document).on('click', function() {
        $('.dropdown-menu').addClass('hidden');
    });

    // AJAX request to update user
    $('form[id^="editUserForm"]').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var userId = $(this).data('user-id'); // Get the user ID from the form
        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: `/usermanagement/${userId}`,
            type: "PUT",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response); // Log the success response
                Swal.fire({
                    title: 'Success!',
                    text: 'User updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page or update the UI
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Log the error response
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update user: ' + (xhr.responseJSON.message || 'Unknown error'),
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        });
    });
});


// Use SweetAlert to confirm deletion
function confirmDelete(userId) {
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
            // Proceed with AJAX delete request
            const form = document.getElementById(`deleteForm${userId}`);
            const formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response
                    Swal.fire('Deleted!', 'The user has been deleted.', 'success').then(() => {
                        location.reload(); // Reload the page or update the UI
                    });
                },
                error: function(xhr) {
                    // Handle error response
                    Swal.fire('Error!', 'There was a problem deleting the user.', 'error');
                }
            });
        }
    });
}

// Add Users modal function
const openModalButton = document.getElementById('openAddModalButton');
const closeModalButton = document.getElementById('closeAddModalButton');
const modal = document.getElementById('addModal');
const modalContent = document.getElementById('addModalContent');

// Open the modal
openModalButton.addEventListener('click', () => {
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-175', 'opacity-50');
    }, 10);
});

// Close the modal
closeModalButton.addEventListener('click', closeModal);
modal.addEventListener('click', (e) => {
    if (!modalContent.contains(e.target)) {
        closeModal();
    }
});

// Function to close the modal
function closeModal() {
    modalContent.classList.add('scale-175', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}
</script>
@endsection
