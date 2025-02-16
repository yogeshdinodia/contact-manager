@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">
            <i class="fa-solid fa-user-edit"></i> Edit Contact
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

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-user"></i> Name:</label>
                <input type="text" name="name" class="form-control" required value="{{ $contact->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-phone"></i> Phone:</label>
                <input type="text" name="phone" class="form-control" required value="{{ $contact->phone }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa-solid fa-save"></i> Update Contact
            </button>
        </form>

        <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3 w-100">
            <i class="fa-solid fa-arrow-left"></i> Back to Contacts
        </a>
    </div>
</div>
@endsection
