@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de centros de formación</h1>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="5">
                    <a href="{{ route('trainingCenter.create') }}" class="btn btn-outline-success btn-sm">Nuevo centro</a>
                    </td>
                </tr>

                @forelse ($trainingCenters as $trainingCenter)
                    <tr>
                        <td>{{ $trainingCenter['id'] }}</td>
                        <td>{{ $trainingCenter['name'] }}</td>
                        <td>{{ $trainingCenter['location'] }}</td>
                        <td><img src="{{ $trainingCenter['imagen_url'] ?? '' }}" alt="{{ $trainingCenter['name'] }}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('trainingCenter.show', $trainingCenter['id']) }}" class="btn btn-info btn-sm">Ver más</a>
                            <a href="{{ route('trainingCenter.edit', $trainingCenter['id']) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('trainingCenter.destroy', $trainingCenter['id']) }}" method="POST"
                                style="display: inline-block;"
                                onsubmit="return confirm('¿Estás seguro de eliminar este centro?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay áreas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection