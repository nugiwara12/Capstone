@extends('layouts.app3')

@section('title', 'Categories')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
    </div>
    <hr />
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($category->count() > 0)
                @foreach($category as $category)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $category->category_name }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form id="deleteForm-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger m-0" onclick="confirmation(event, {{ $category->id }})">Delete</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Category not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
