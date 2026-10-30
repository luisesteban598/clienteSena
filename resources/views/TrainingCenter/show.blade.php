@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-success">Detalles de centro de formación</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $trainingCenter['id'] }}</td>
                    <td>{{ $trainingCenter['name'] }}</td>
                    <td>{{ $trainingCenter['location'] }}</td>
                    <td><img src="{{ $trainingCenter['imagen_url'] ?? '' }}" alt="{{ $trainingCenter['name'] }}" width="100"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection