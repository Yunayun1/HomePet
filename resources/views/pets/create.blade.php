<!DOCTYPE html>
<html>
<head>
    <title>Add Pet</title>
    <style>
        .container { max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea, select { width: 100%; padding: 8px; }
        button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Pet</h2>
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="shelter_id" value="{{ Auth::id() }}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" min="0">
            </div>
            <div class="form-group">
                <label for="behavior">Behavior</label>
                <input type="text" name="behavior" id="behavior">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <button type="submit">Add Pet</button>
        </form>
    </div>
</body>
</html>