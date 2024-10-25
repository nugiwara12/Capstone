@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <!-- Search Form -->
    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('order.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." class="border border-gray-300 rounded-md px-4 py-2" />
            <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2 hover:bg-blue-700">Search</button>
            <a href="{{ route('order.index') }}" class="bg-gray-300 text-black rounded-md px-4 py-2 hover:bg-gray-400 no-underline hover:no-underline">Reset</a> <!-- Reset Button -->
        </form>
    </div>

    <!-- Orders Card -->
    <div class="min-h-full mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Customer Name</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-normal text-black font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400">
                    @forelse ($orders as $ord)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $ord->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $ord->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $ord->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $ord->product_title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ number_format($ord->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $ord->delivery_status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-left relative">
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="confirmAction('{{ route('order.preparing', $ord->id) }}', 'Preparing')" class="flex items-center justify-center w-10 h-10 text-white bg-gray-600 hover:bg-yellow-500 rounded-full" title="Mark as Preparing">
                                    <i class="fas fa-tools"></i>
                                </button>
                                <button type="button" onclick="confirmAction('{{ route('order.packed', $ord->id) }}', 'Packed')" class="flex items-center justify-center w-10 h-10 text-white bg-yellow-600 hover:bg-yellow-500 rounded-full" title="Mark as Packed">
                                    <i class="fas fa-box"></i>
                                </button>
                                <button type="button" onclick="confirmAction('{{ route('order.shipped', $ord->id) }}', 'Shipped')" class="flex items-center justify-center w-10 h-10 text-white bg-blue-600 hover:bg-blue-500 rounded-full" title="Mark as Shipped">
                                    <i class="fas fa-plane"></i>
                                </button>
                                <button type="button" onclick="confirmAction('{{ route('order.delivered', $ord->id) }}', 'Delivered')" class="flex items-center justify-center w-10 h-10 text-white bg-green-600 hover:bg-green-500 rounded-full" title="Mark as Delivered">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button class="flex items-center justify-center w-10 h-10 text-white bg-red-600 hover:bg-red-500 rounded-full" onclick="confirmDelete({{ $ord->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-2 px-4 text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Show Entries Form -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <div class="flex items-center mb-2 md:mb-0">
                <form method="GET" action="{{ route('order.index') }}" class="flex items-center">
                    <label for="per_page" class="mr-2 text-sm mt-2">Show</label>
                    <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <span class="text-sm ml-2">of <strong>{{ $orders->total() }}</strong> entries</span>
            </div>

            <!-- Pagination Section -->
            <div class="md:mt-0">
                <x-pagination-order :orders="$orders" />
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="mt-4">
        {{ $orders->links() }} <!-- Include pagination links -->
    </div>
</div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(orderId) {
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
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/orders/${orderId}`; // Adjust the action URL as per your route
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmAction(actionUrl, actionName) {
        Swal.fire({
            title: `Are you sure you want to mark as ${actionName}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = actionUrl; // URL passed from the button's onclick
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();

                // Show success message after form submission
                Swal.fire({
                    title: 'Success!',
                    text: `Order marked as ${actionName} successfully.`,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    timer: 2000, // Optional: Auto close after 2 seconds
                    willClose: () => {
                        // Reload the page to see the changes after success
                        location.reload();
                    }
                });
            }
        });
    }
</script>
@endsection
