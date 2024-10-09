@extends('layouts.app3')

@section('title', 'Edit Users')

@section('contents')
   <hr />
    <form action="{{ route('usermanagement.update', $users->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $users->name }}" >
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- <div class="col mb-3">
            <label class="form-label">Role</label>
                <fieldset class="form-group">
                    <select class="form-select" name="role" id="role" value="{{ $users->role }}">
                        <option selected disabled>{{ $users->role }}</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                <div class="form-control-icon">
                    <i class="bi bi-exclude"></i>
               </div>
                </fieldset>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div> -->


        <!-- Role -->
        <div class="form-group">
            <label class="form-label">Role</label>
                <input name="role" type="text" class="form-control form-control-user @error('role')is-invalid @enderror" id="exampleInputName" placeholder="Role" value="User" readonly>
                @error('role')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ $users->email }}" >
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
@endsection
