@extends('layouts.app3')

@section('title', 'Create Category')
@section('contents')
@if (Auth::check() && in_array(Auth::user()->role, ['admin', 'seller']))

    <hr />

    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col mb-3" >
                <div class="row mb-3">
                    <input type="text" name="category_name" class="form-control" placeholder="Category" required>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
    @endif
@endsection
