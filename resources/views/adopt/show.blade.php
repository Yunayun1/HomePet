<!DOCTYPE html>
<html>
<head>
    <title>{{ $pet->name }} Details</title>
    <style>
        .container { max-width: 600px; margin: 50px auto; padding: 20px; }
        .detail { margin-bottom: 15px; }
        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $pet->name }}</h2>
        <img src="{{ asset('images/' . $pet->image) }}" alt="{{ $pet->name }}">
        <div class="detail">Type: {{ $pet->type }}</div>
        <div class="detail">Age: {{ $pet->age ?? 'N/A' }}</div>
        <div class="detail">Behavior: {{ $pet->behavior ?? 'N/A' }}</div>
        <div class="detail">Description: {{ $pet->description ?? 'N/A' }}</div>
        <div class="detail">Location: {{ $pet->location ?? 'N/A' }}</div>
    </div>
</body>
</html>