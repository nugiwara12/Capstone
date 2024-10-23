@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <div class="min-h-full mt-4">
        <!-- Success Message -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <form method="GET" action="{{ route('products') }}" class="flex items-center">
                    <input type="text" name="search" class="border border-gray-300 rounded px-2 py-1 text-sm" placeholder="Search products" value="{{ request('search') }}">
                    <button type="submit" class="ml-2 px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-500">Search</button>
                </form>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
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
                    @if($product->count() > 0)
                        @foreach($product as $rs)
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
                                    <a href="{{ route('products.show', $rs->id) }}" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white hover:bg-blue-500" title="Show">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $rs->id) }}" class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white hover:bg-green-500" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="deleteForm{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500" onclick="confirmDelete('{{ $rs->id }}')" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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

@endsection
