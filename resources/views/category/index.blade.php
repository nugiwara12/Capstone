@extends('layouts.app3')

@section('contents')

<div class="w-full">
    <div class="min-h-full mt-4">
        <!-- Success Message -->

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
                    @forelse ($category as $category)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black">{{ $loop->iteration + (($category->currentPage() - 1) * $category->perPage()) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $category->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $category->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-left relative">
                            <div class="flex items-center space-x-2">
                                <a href="javascript:void(0)" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white hover:bg-blue-500 focus:outline-none" data-toggle="modal" data-target="#editcategoryModal{{ $category->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form id="deleteForm{{ $category->id }}" action="{{ route('categorymanagement.destroy', $category->id) }}" method="POST" class="block delete-form" role="menuitem">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white hover:bg-red-500 focus:outline-none" onclick="confirmDelete('{{ $category->id }}')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center">No category found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
