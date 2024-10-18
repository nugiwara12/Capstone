@extends('layouts.app3')

@section('title', 'List Product')
<link rel="stylesheet" href="{{asset('admin_assets/css/dropdown.css')}}">
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
                        <td class="align-middle"><img src="{{ asset('images/' . $rs->main_image) }}"  width="100"></td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{$rs->title}}</td>
                        <td class="align-middle">{{ $rs->category }}</td>
                        <td class="align-middle">&#8369; {{ $rs->price }}</td>
                        <td class="align-middle">
                                <div class="dropdown">
                                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    . . .
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('products.show', $rs->id) }}">Show</a></li>
                                    <li><a class="dropdown-item" href="{{ route('products.edit', $rs->id)}}">Edit</a></li>
                                    <li><form id="deleteForm-{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a class="dropdown-item" href="#" onclick="confirmation(event, {{ $rs->id }})">Delete</a>
                                    </form></li>
                                  </ul>
                                </div>
                            {{-- <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form id="deleteForm-{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger m-0" onclick="confirmation(event, {{ $rs->id }})">Delete</button>
                                </form>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
@endsection
