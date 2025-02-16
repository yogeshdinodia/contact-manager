@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-center mb-4">Trashed Contacts</h2>

    <a href="{{ route('contacts.index') }}" class="btn btn-primary mb-3">Back to Contacts</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($trashedContacts) > 0)
                @foreach($trashedContacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>
                            <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>

                            <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Permanently Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="3" class="text text-info text-center">No contact is deleted yet!</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
