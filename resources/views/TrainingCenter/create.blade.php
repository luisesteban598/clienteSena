@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Nuevo registro</span>
            <h1>Registrar centro de formación</h1>
            <p>Completa los datos y guarda el registro.</p>
        </div>
        <a href="{{ route('trainingCenter.index') }}" class="management-secondary-action">Volver a centros</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('trainingCenter.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Guardar centro</button>
                <a href="{{ route('trainingCenter.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
