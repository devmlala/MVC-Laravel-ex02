<!DOCTYPE html>
<html>
<head>
    <title>Exercise Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Exercise Details</h1>
        <div class="mb-3">
            <strong>Diet:</strong> {{ $exercise->diet }}
        </div>
        <div class="mb-3">
            <strong>Pulse:</strong> {{ $exercise->pulse }}
        </div>
        <div class="mb-3">
            <strong>Kind:</strong> {{ $exercise->kind }}
        </div>
        <a href="{{ route('exercises.index') }}" class="btn btn-secondary">Back</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
