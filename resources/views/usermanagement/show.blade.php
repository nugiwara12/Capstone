@extends('layouts.app3')
  
@section('title', 'Show Users')
  
@section('contents')
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $users->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Role</label>
            <input type="text" name="role" class="form-control" placeholder="Role" value="{{ $users->role }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ $users->email }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $users->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $users->updated_at }}" readonly>
        </div>
    </div>
@endsection