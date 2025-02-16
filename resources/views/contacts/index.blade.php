@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-center mb-4">Contacts</h2>

    <a href="{{ route('contacts.trashed') }}" class="btn btn-warning mb-3">View Trashed Contacts</a>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary text-white mb-3">Add Contacts</a>
    <button id="bulkImportBtn" class="btn btn-info text-white mb-3"><i class="fa-solid fa-file-import"></i> Bulk Import Contacts </button>

    <div class="importForm" style="display: none;">
        <form action="{{ route('contacts.importXML') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <input type="file" name="xml_file" class="form-control" required>
            <button type="submit" class="btn btn-success mt-2">
                <i class="fa-solid fa-upload"></i> Import XML
            </button>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($contacts) > 0)
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td class="d-flex align-items-center">
                            <a class="btn btn-info text-white btn-sm me-2" href="{{ route('contacts.edit', $contact->id) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>                        
                    </tr>
                @endforeach
            @else
                <tr><td colspan="3" class="text text-info text-center">No contact is added yet!</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('additional-footer')
<script>
    $(document).ready(function () {
        $("#bulkImportBtn").click(function (){ $(".importForm").toggle(); });
    });
</script>
@endsection
