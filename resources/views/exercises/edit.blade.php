<!DOCTYPE html>
<html>
<head>
    <title>Edit Exercise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Exercise</h1>
        <form action="{{ route('exercises.update', $exercise->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="diet" class="form-label">Diet</label>
                <input type="text" class="form-control" id="diet" name="diet" value="{{ $exercise->diet }}" required>
            </div>
            <div class="mb-3">
                <label for="pulse" class="form-label">Pulse</label>
                <input type="number" class="form-control" id="pulse" name="pulse" value="{{ $exercise->pulse }}" required>
            </div>
            <div class="mb-3">
                <label for="kind" class="form-label">Kind</label>
                <input type="text" class="form-control" id="kind" name="kind" value="{{ $exercise->kind }}" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ $exercise->time }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
