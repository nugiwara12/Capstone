@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <div class="min-h-full mt-4">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <form method="GET" action="{{ route('products') }}" class="relative w-full flex items-center">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="bi bi-tag text-gray-500"></i>
                    </div>
                    <input type="search" id="search" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-5 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm transition duration-150 ease-in-out hover:border-blue-400"
                    placeholder="SEARCH" />
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-4">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary ml-4">Add Product</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-black uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Product Code</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-black uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-black uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                    @if($products->count() > 0)
                        @foreach($products as $rs)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <img src="{{ asset('images/' . $rs->main_image) }}" width="50" alt="{{ $rs->title }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $rs->product_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $rs->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $rs->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-right">&#8369; {{ number_format($rs->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-right relative">
                                <div class="flex justify-end space-x-2">
                                    @if($rs->status === 1) {{-- If not deleted --}}
                                        <a href="{{ route('products.show', $rs->id) }}" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white hover:bg-blue-500" title="Show">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $rs->id) }}" class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white hover:bg-green-500" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form id="deleteForm{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500" onclick="confirmDelete('{{ $rs->id }}')" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else {{-- If deleted --}}
                                        <form id="restoreForm{{ $rs->id }}" action="{{ route('products.restore', $rs->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white hover:bg-green-500" onclick="confirmRestore('{{ $rs->id }}')" title="Restore">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="py-2 px-4 text-center">No products found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- pagination -->
</div>

<script>
function confirmDelete(id) {
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
            $.ajax({
                url: $('#deleteForm' + id).attr('action'), // Get the URL from the form action
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}' // Pass the CSRF token
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'Product deleted successfully!', 'success').then(() => {
                        location.reload(); // Reload the page to show updated data
                    });
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Error deleting product: ' + xhr.responseText, 'error');
                }
            });
        }
    });
}

function confirmRestore(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to restore this product?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: $('#restoreForm' + id).attr('action'), // Get the URL from the form action
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Pass the CSRF token
                },
                success: function(response) {
                    Swal.fire('Restored!', 'Product restored successfully!', 'success').then(() => {
                        location.reload(); // Reload the page to show updated data
                    });
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Error restoring product: ' + xhr.responseText, 'error');
                }
            });
        }
    });
}
</script>
@endsection
