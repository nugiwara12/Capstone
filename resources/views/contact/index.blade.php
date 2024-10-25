@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <!-- add card -->
    <div class="min-h-full mt-4">
        <!-- Success Message -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Mobile</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                    @forelse ($contacts as $contact)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->message }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-left relative">
                            <div class="flex items-center space-x-2">
                                <form id="deleteForm{{ $contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="block delete-form" role="menuitem">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500 focus:outline-none" onclick="confirmDelete('{{ $contact->id }}')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center">No contact found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Show Entries Form -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="flex items-center mb-2 md:mb-0">
            <form method="GET" action="{{ route('contact') }}" class="flex items-center">
                <label for="per_page" class="mr-2 text-sm mt-2">Show</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            <span class="text-sm ml-2">of <strong>{{ $contacts->total() }}</strong> entries</span>
        </div>

        <!-- Pagination Section -->
        <div class="md:mt-0">
            <x-pagination-contact :contacts="$contacts" />
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(contactId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the corresponding form
                document.getElementById('deleteForm' + contactId).submit();
            }
        });
    }
</script>
@endsection
