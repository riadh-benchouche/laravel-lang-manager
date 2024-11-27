<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Translations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        .success {
            color: green;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Manage Translations</h1>

@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('lang-manager.update') }}">
    @csrf
    @foreach ($translations as $locale => $files)
        <h2>{{ strtoupper($locale) }}</h2>
        @foreach ($files as $file => $items)
            <h3>{{ ucfirst($file) }}</h3>
            @foreach ($items as $key => $value)
                <label>
                    {{ $key }}
                    <input type="text" name="translations[{{ $locale }}][{{ $file }}][{{ $key }}]" value="{{ $value }}">
                </label>
            @endforeach
        @endforeach
    @endforeach
    <button type="submit">Save Changes</button>
</form>
</body>
</html>
