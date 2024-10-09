@extends('layouts.app3')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Contact Details</h2>

    <div class="row mb-2">
        <div class="col-sm-3"><strong>Name:</strong></div>
        <div class="col-sm-9">{{ $contact->name }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-3"><strong>Email:</strong></div>
        <div class="col-sm-9">{{ $contact->email }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-3"><strong>Phone:</strong></div>
        <div class="col-sm-9">{{ $contact->phone }}</div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-3"><strong>Message:</strong></div>
        <div class="col-sm-9">{{ $contact->message }}</div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('contacts.index') }}" class="btn btn-primary">Back to Contacts</a>
        </div>
    </div>
</div>

@endsection