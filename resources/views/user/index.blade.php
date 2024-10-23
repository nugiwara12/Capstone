@extends('layouts.app4')

@section('contents')

<div>
    <nav>
        <div class="nav-middle">
            <a href="{{ route('best-sellers') }}" class="active">
                <i class="">Best Seller</i>
            </a>

            <a href="{{ route('shops') }}">
                <i class="">Product</i>
            </a>

            <a href="{{ route('featured') }}">
                <i class="">Features</i>
            </a>
        </div>

        <div class="nav-right">
            <span class="profile"></span>

            <a href="javascript:void(0)">
                <i class="fa fa-bell"></i>
            </a>

            <a href="javascript:void(0)">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </nav>
</div>
@endsection