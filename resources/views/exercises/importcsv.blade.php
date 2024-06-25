<!DOCTYPE html>
<html>
<head>
    <title>Importar CSV</title>
</head>
<body>
    <h1>Importar CSV</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('exercises.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">Escolha o arquivo CSV:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div>
            <button type="submit">Importar</button>
        </div>
    </form>
</body>
</html>
