<!DOCTYPE html>
<html>
<head>
    <title>Lista de Livros</title>
    <!-- Incluindo o Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Lista de Livros Aleatórios</h2>
    <a href="{{ route('gerar-csv.csv') }}" class="btn btn-primary mb-3">Download CSV</a>
    <a href="{{ route('livrofulano.create') }}" class="btn btn-success mb-3">Adicionar Novo Livro</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->id }}</td>
                    <td>{{ $registro->titulo }}</td>
                    <td>{{ $registro->autor }}</td>
                    <td>{{ $registro->isbn }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Links de Paginação -->
    <div class="d-flex justify-content-center">
        {{ $registros->links() }}
    </div>


   


</div>

</body>
</html>

















































