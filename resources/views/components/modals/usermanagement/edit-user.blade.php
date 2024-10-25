<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content h-[600px] overflow-hidden">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close text-2xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm{{ $user->id }}" data-user-id="{{ $user->id }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Name</label>
                        <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Email Address</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email Address" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Role</label>
                        <select name="role" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                            <option value="users" {{ (old('role', $user->role) == 'users') ? 'selected' : '' }}>Users</option>
                            <option value="seller" {{ (old('role', $user->role) == 'seller') ? 'selected' : '' }}>Seller</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input name="phone" type="text" id="phone" placeholder="09XXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)" 
                            maxlength="11" required value="{{ old('phone', $user->phone) }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Tell About Yourself</label>
                        <textarea name="description" rows="5" class="w-full h-40 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tell About Yourself">{{ old('description', $user->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="mt-5 w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
