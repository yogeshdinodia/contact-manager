@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">
            <i class="fa-solid fa-user-plus"></i> Add New Contact
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-user"></i> Name:</label>
                <input type="text" name="name" class="form-control" required placeholder="Enter Contact Name">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-phone"></i> Phone:</label>
                <input type="text" name="phone" class="form-control" required placeholder="Enter Phone Number">
            </div>
            <button type="submit" class="btn btn-success w-100"> <i class="fa-solid fa-save"></i> Save Contact </button>
        </form>

        <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3 w-100">
            <i class="fa-solid fa-arrow-left"></i> Back to Contacts
        </a>
    </div>
</div>
@endsection
