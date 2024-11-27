<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Translations</title>
    <link rel="stylesheet" href="{{ asset('css/lang-manager.css') }}">
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
            <table>
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            <input type="text" name="translations[{{ $locale }}][{{ $file }}][{{ $key }}]" value="{{ $value }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
    <button type="submit">Save Changes</button>
</form>
</body>
</html>
