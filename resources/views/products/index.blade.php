@extends('layouts.app3')

@section('title', 'List Product')
<link rel="stylesheet" href="{{ asset('admin_assets/css/dropdown.css') }}">

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($product->count() > 0)
                @foreach($product as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle"><img src="{{ asset('images/' . $rs->main_image) }}" width="100"></td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->category }}</td>
                        <td class="align-middle">&#8369; {{ $rs->price }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton-{{ $rs->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    . . .
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $rs->id }}">
                                    <li><a class="dropdown-item" href="{{ route('products.show', $rs->id) }}">Show</a></li>
                                    <li><a class="dropdown-item" href="{{ route('products.edit', $rs->id) }}">Edit</a></li>
                                    <li>
                                        <form id="deleteForm-{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a class="dropdown-item" href="#" onclick="confirmation(event, {{ $rs->id }})">Delete</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="7">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> <!-- Add this line -->
    
    <script>
        function confirmation(event, id) {
            event.preventDefault(); // Prevent the default link behavior
            const form = document.getElementById(`deleteForm-${id}`);
            if (confirm("Are you sure you want to delete this product?")) {
                form.submit(); // Submit the form if confirmed
            }
        }
    </script>
@endsection
