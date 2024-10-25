@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <div class="min-h-full mt-4">
        <x-chart.product-chart />
        <div class="flex justify-between items-center">
        <!-- Left Section: Search Form -->
            <div class="mr-4">
                <form method="GET" action="{{ route('products') }}" class="relative flex items-center">
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

            <!-- Right Section: Add Product Button and Sales Filter -->
            <div class="flex items-center">
                <!-- Add Product Button -->
                <a href="{{ route('products.create') }}" class="flex-1 px-2 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 no-underline hover:no-underline text-center">
                    <i class="bi bi-plus-circle"></i>
                    Add Product
                </a>

                <!-- Sales Filter Date -->
                <div class="flex-1">
                    <x-sales.filter-date />
                </div>
            </div>
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
                                    @if($rs->status === 1)
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
                                    @else
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

    <!-- Pagination Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="flex items-center mb-2 md:mb-0">
            <form method="GET" action="{{ route('products') }}" class="flex items-center">
                <label for="per_page" class="mr-2 text-sm mt-2">Show</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            <span class="text-sm ml-2">of <strong>{{ $products->total() }}</strong> entries</span>
        </div>

        <div class="md:mt-0">
            <x-product-pagination :products="$products" />
        </div>
    </div>
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
                url: $('#deleteForm' + id).attr('action'),
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'Product deleted successfully!', 'success').then(() => {
                        location.reload();
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
                url: $('#restoreForm' + id).attr('action'),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Restored!', 'Product restored successfully!', 'success').then(() => {
                        location.reload();
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
