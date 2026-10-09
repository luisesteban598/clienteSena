@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Edición de registro</span>
            <h1>Editar área</h1>
            <p>Registro #{{ str_pad($area['id'], 3, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('area.index') }}" class="management-secondary-action">Volver a áreas</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('area.update', $area['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $area['name'] ?? '') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Actualizar</button>
                <a href="{{ route('area.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
