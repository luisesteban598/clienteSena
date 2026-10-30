@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de áreas</h1>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="4">
                    <a href="{{ route('area.create') }}" class="btn btn-outline-success btn-sm">Nueva area </a>
                    </td>
                </tr>

                @forelse ($areas as $area)
                    <tr>
                        <td>{{ $area['id'] }}</td>
                        <td>{{ $area['name'] }}</td>
                        <td><img src="{{ $area['imagen_url'] ?? '' }}" alt="{{ $area['name'] }}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('area.show', $area['id']) }}" class="btn btn-info btn-sm">Ver más</a>
                            <a href="{{ route('area.edit', $area['id']) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('area.destroy', $area['id']) }}" method="POST"
                                style="display: inline-block;"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta área?')">

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