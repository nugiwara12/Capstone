<div class="border-b bg-gray-50 rounded-lg bg-gray-100 py-2">
    <div class="flex justify-between items-center">
        <!-- Search Form -->
        <div class="mb-2 w-full md:w-auto">
            <form method="GET" action="{{ route('usermanagement') }}" class="relative w-full flex items-center">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="bi bi-tag text-gray-500"></i>
            </div>
            <input type="search" id="search"  name="search" "
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
                <i class="bi bi-person-plus"></i> Add Users
            </button>
        </div>
    </div>
</div>


<!-- Add Users Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0" id="addModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-2 border-b">
            <h5 class="text-md font-bold" id="addModalLabel">Register Account</h5>
            <button type="button" class="text-3xl" id="closeAddModalButton">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="p-3 overflow-auto">
            <div class="flex justify-center">
                <!-- Add Form -->
                <form id="userRegistrationForm" method="POST" action="{{ route('register.save') }}" class="w-full space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-semibold" />
                            <x-text-input id="name" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Full Name" />
                            <x-input-error :messages="$errors->get('name')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                            <x-text-input id="email" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Email Address" />
                            <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <x-input-label for="role" :value="__('Role')" class="text-gray-700 font-semibold" />
                            <select id="role" name="role" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>{{ __('Select Role') }}</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                <option value="users" {{ old('role') == 'users' ? 'selected' : '' }}>{{ __('Users') }}</option>
                                <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>{{ __('Seller') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-700 font-semibold" />
                            <x-text-input id="phone" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)" maxlength="11" placeholder="Phone Number" />
                            <x-input-error :messages="$errors->get('phone')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="">
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                            <x-text-input id="password" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-2" />
                            <div class="text-xs text-gray-500 italic mt-1">Must be 8-20 characters long, include at least 1 number and both upper and lower case letters.</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-semibold" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="show-password" class="h-4 w-4">
                            <label for="show-password" class="ml-2 text-sm text-gray-700">Show Password</label>
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <x-input-label for="description" :value="__('Tell About Yourself')" class="text-gray-700 font-semibold" />
                            <textarea name="description" id="description" required placeholder="Description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="text-red-500 text-sm mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="col-span-2">
                            <button type="submit" class="w-full bg-blue-700 text-white p-2 rounded-md shadow hover:bg-blue-880 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
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

    // Submit form via AJAX
    $('#userRegistrationForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('usermanagement.store') }}", // Your Laravel route for storing users
            type: "POST",
            data: formData,
            success: function(response) {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: 'User registered successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Close the modal and reset the form
                    $('#addModalContent').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                    setTimeout(function() {
                        $('#addModal').addClass('hidden'); // Close the modal
                        $('#userRegistrationForm')[0].reset(); // Reset the form
                        window.location.reload();
                    }, 300); // Match the timeout with the duration of the fade effect
                });
            },
            error: function(xhr) {
                // Handle validation errors
                var errorMessage = 'Registration failed. Please check your input.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Get the first validation error message
                    errorMessage = Object.values(xhr.responseJSON.errors).flat().join(', ');
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

// Show Password
const showPasswordCheckbox = document.getElementById('show-password');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('password_confirmation');

showPasswordCheckbox.addEventListener('change', function () {
    const passwordType = this.checked ? 'text' : 'password';
    passwordInput.type = passwordType;
    confirmPasswordInput.type = passwordType;
});
</script>
@endsection