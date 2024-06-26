<!-- resources/views/import/result.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Média do Pulse</h2>
        <p>A média do pulse dos dados importados é: {{ $mediaPulse }}</p>
    </div>
@endsection
