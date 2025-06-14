@extends('layouts.admin')

@section('content')
<style>
    body {
        color: black;
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        color: black;
    }

    h1, h2 {
        color: black;
        text-align: left;
        margin-bottom: 30px;
        font-size: 2.5em;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .create-pet-btn {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
    }

    .create-pet-btn:hover {
        background-color: #0056b3;
    }

    /* Search form styles */
    form.search-form {
        margin-bottom: 20px;
    }

    form.search-form input[type="text"] {
        padding: 8px 12px;
        width: 300px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    form.search-form button {
        padding: 8px 16px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        margin-left: 8px;
        transition: background-color 0.3s ease;
    }

    form.search-form button:hover {
        background-color: #0056b3;
    }

    form.search-form a.clear-btn {
        margin-left: 10px;
        color: #dc3545;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
    }

    form.search-form a.clear-btn:hover {
        text-decoration: underline;
    }

    .pet-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        color: black;
    }

    .pet-table th,
    .pet-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        vertical-align: middle;
    }

    .pet-table th {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9em;
    }

    .pet-table tbody tr:hover {
        background-color: #e0e0e0;
    }

    .actions-column a,
    .actions-column button {
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.85em;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-right: 5px;
        border: none;
        display: inline-block;
        color: white;
    }

    .actions-column a.edit-btn {
        background-color: #17a2b8;
    }
    .actions-column a.edit-btn:hover {
        background-color: #117a8b;
    }

    .actions-column button.delete-btn {
        background-color: #dc3545;
    }
    .actions-column button.delete-btn:hover {
        background-color: #c82333;
    }

    img.pet-thumb {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        object-position: center center;
        display: block;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
        cursor: pointer; /* Add cursor pointer to indicate it's clickable */
    }

    /* Styles for the image modal */
    .image-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        padding-top: 50px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    .image-modal-content {
        margin: auto;
        display: block;
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }

    /* Close button */
    .close-modal {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close-modal:hover,
    .close-modal:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Pets Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.managepet.index') }}" class="search-form">
        <input
            type="text"
            name="search"
            placeholder="Search pets by name"
            value="{{ request('search') }}"
        >
        <button type="submit">Search</button>

        @if(request('search'))
            <a href="{{ route('admin.managepet.index') }}" class="clear-btn">Clear</a>
        @endif
    </form>

    <a href="{{ route('admin.managepet.create') }}" class="create-pet-btn">+ Add New Pet</a>

    <table class="pet-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Age</th>
                <th>Behavior</th>
                <th>Shelter</th>
                <th>Location</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pets as $index => $pet)
                <tr>
                    <td>{{ $index + $pets->firstItem() }}</td>
                    <td>
                        @if ($pet->image)
                            {{-- Add data-full-src for the full image path --}}
                            <img src="{{ asset('images/' . $pet->image) }}"
                                 alt="{{ $pet->name }}"
                                 class="pet-thumb"
                                 data-full-src="{{ asset('images/' . $pet->image) }}" />
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->age ?? '-' }}</td>
                    <td>{{ $pet->behavior ?? '-' }}</td>
                    <td>{{ $pet->shelter ? $pet->shelter->name : 'N/A' }}</td>
                    <td>{{ $pet->location ?? '-' }}</td>
                    <td class="actions-column">
                        <a href="{{ route('admin.managepet.edit', $pet->id) }}" class="edit-btn">Edit</a>

                        <form action="{{ route('admin.managepet.destroy', $pet->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this pet?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No pets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $pets->links() }}
    </div>
</div>

<div id="imageModal" class="image-modal">
    <span class="close-modal">&times;</span>
    <img class="image-modal-content" id="img01">
</div>

<script>
    // Get the modal
    var modal = document.getElementById("imageModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var images = document.querySelectorAll(".pet-thumb");
    var modalImg = document.getElementById("img01");

    images.forEach(function(img) {
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.getAttribute('data-full-src'); // Use data-full-src for full image
        }
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-modal")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the image, close the modal
    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection