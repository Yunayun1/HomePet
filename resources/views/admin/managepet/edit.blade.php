@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Pet: {{ $pet->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Pet Name</label>
            <input type="text" name="name" value="{{ old('name', $pet->name) }}" class="form-control" required>
        </div>

        <div>
            <label>Type</label>
            <input type="text" name="type" value="{{ old('type', $pet->type) }}" class="form-control" required>
        </div>

        <div>
            <label>Age</label>
            <input type="text" name="age" value="{{ old('age', $pet->age) }}" class="form-control">
        </div>

        <div>
            <label>Behavior</label>
            <input type="text" name="behavior" value="{{ old('behavior', $pet->behavior) }}" class="form-control">
        </div>

        <div>
            <label>Location Link</label>
            <input type="text" name="location" value="{{ old('location', $pet->location) }}" class="form-control">
        </div>

        <div>
            <label>Current Image</label><br>
            @if ($pet->image)
                <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" width="100">
            @else
                <span>No image uploaded</span>
            @endif
        </div>

        <div>
            <label>Upload New Image (optional)</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <div>
            <label>Select Shelter</label>
            <select name="shelter_id" class="form-control" required>
                @foreach ($shelters as $shelter)
                    <option value="{{ $shelter->id }}" {{ $pet->shelter_id == $shelter->id ? 'selected' : '' }}>
                        {{ $shelter->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="create-pet-btn mt-3">Update Pet</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
