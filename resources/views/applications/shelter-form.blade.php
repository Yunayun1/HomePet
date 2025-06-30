@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Shelter Applications Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($shelterApplications->count() > 0)
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Organization Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Message</th>
                <th>License Document</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shelterApplications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->organization_name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->phone ?? '-' }}</td>
                    <td>{{ $application->address }}</td>
                    <td>{{ $application->message ?? '-' }}</td>
                    <td>
                        @if($application->proof_document)
                            <a href="{{ asset('storage/' . $application->proof_document) }}" target="_blank">View Document</a>
                        @else
                            No Document
                        @endif
                    </td>
                    <td>
                        <span class="badge 
                            @if($application->status == 'Approved') bg-success
                            @elseif($application->status == 'Rejected') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $application->status ?? 'Pending' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.shelters.update', $application->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Approved">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>

                        <form action="{{ route('admin.shelters.update', $application->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Rejected">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $shelterApplications->links() }}

    @else
        <p>No shelter applications found.</p>
    @endif
</div>
@endsection
