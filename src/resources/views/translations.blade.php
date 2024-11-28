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
    <table>
        <thead>
        <tr>
            <th>Key</th>
            <th>File</th>
            @foreach (array_keys($translations) as $locale)
                <th>{{ strtoupper($locale) }}</th>
            @endforeach
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="translation-table">
        @foreach ($translations[array_key_first($translations)] as $file => $keys)
            @foreach ($keys as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>
                        <input type="text" name="files[{{ $key }}]" value="{{ $file }}">
                    </td>
                    @foreach ($translations as $locale => $files)
                        <td>
                            <input type="text" name="translations[{{ $locale }}][{{ $file }}][{{ $key }}]"
                                   value="{{ $files[$file][$key] ?? '' }}">
                        </td>
                    @endforeach
                    <td>
                        <button type="button" class="delete-row">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
    <button type="button" id="add-row">Add New Translation</button>
    <button type="submit">Save Changes</button>
</form>


<script>
    // Add a new translation row dynamically
    document.getElementById('add-row').addEventListener('click', function () {
        const tableBody = document.getElementById('translation-table');
        const locales = @json(array_keys($translations));
        const newRow = document.createElement('tr');

        // Add an empty key cell
        const keyCell = document.createElement('td');
        const keyInput = document.createElement('input');
        keyInput.type = 'text';
        keyInput.name = `new_key[]`;
        keyInput.placeholder = 'Enter key';
        keyCell.appendChild(keyInput);
        newRow.appendChild(keyCell);

        // Add an empty file name cell
        const fileCell = document.createElement('td');
        const fileInput = document.createElement('input');
        fileInput.type = 'text';
        fileInput.name = `new_file[]`;
        fileInput.placeholder = 'Enter file name';
        fileCell.appendChild(fileInput);
        newRow.appendChild(fileCell);

        // Add empty translation cells for each locale
        locales.forEach(locale => {
            const valueCell = document.createElement('td');
            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.name = `new_translations[${locale}][]`;
            valueInput.placeholder = `Enter translation (${locale})`;
            valueCell.appendChild(valueInput);
            newRow.appendChild(valueCell);
        });

        // Add delete button
        const actionCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'delete-row';
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', function () {
            newRow.remove();
        });
        actionCell.appendChild(deleteButton);
        newRow.appendChild(actionCell);

        // Append the new row to the table
        tableBody.appendChild(newRow);
    });

    // Delete an existing row
    document.querySelectorAll('.delete-row').forEach(button => {
        button.addEventListener('click', function () {
            button.closest('tr').remove();
        });
    });
</script>
</body>
</html>
