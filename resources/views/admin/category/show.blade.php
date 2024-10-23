<!-- @extends('layouts.app3')

@section('title', 'Show Category')

@section('contents')
    <hr />
        <div class="row ">
            <div class="col mb-3" >
                <div class="row mb-3">
                    <input type="text" class="form-control" value="{{$category->category_name}}" disabled>
                </div>
                <div><p>Image</p>
                    <div class="mb-3"><img style="height: 150px; width:auto;" src="{{ asset('images/' . $category->image) }}" alt=""></div>
                </div>
            </div>
        </div>
@endsection -->
