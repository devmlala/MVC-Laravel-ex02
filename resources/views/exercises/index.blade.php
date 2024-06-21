<!DOCTYPE html>
<html>
<head>
    <title>Exercises</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Exercises</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('exercises.create') }}" class="btn btn-primary">Add Exercise</a>
            <a href="{{ route('gerarCSV.csv') }}" class="btn btn-secondary">Download CSV</a>
            <a href="{{ route('stats.csv') }}" class="btn btn-secondary">Stats CSV</a>

        </div>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Diet</th>
                    <th>Pulse</th>
                    <th>Kind</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->id }}</td>
                        <td>{{ $exercise->diet }}</td>
                        <td>{{ $exercise->pulse }}</td>
                        <td>{{ $exercise->kind }}</td>
                        <td>{{ $exercise->time }}</td>
            
                        <td>
                            <a href="{{ route('exercises.show', $exercise->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('exercises.edit', $exercise->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
