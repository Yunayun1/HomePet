@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add New Pet</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Pet Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div>
            <label>Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div>
            <label>Age</label>
            <input type="text" name="age" class="form-control">
        </div>

        <div>
            <label>Behavior</label>
            <input type="text" name="behavior" class="form-control">
        </div>

        <div>
            <label>Location Link</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div>
            <label>Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <div>
            <label>Select Shelter</label>
            <select name="shelter_id" class="form-control" required>
                <option value="">-- Select Shelter --</option>
                @foreach ($shelters as $shelter)
                    <option value="{{ $shelter->id }}">{{ $shelter->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="create-pet-btn mt-3">Save Pet</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
