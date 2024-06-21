<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Novo Livro</title>
    <!-- Incluindo o Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Adicionar Novo Livro</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('livrofulano.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="number" class="form-control" id="isbn" name="isbn" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</div>

</body>
</html>
