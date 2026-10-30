@extends('layouts.app')

@section('content')
<main class="management-page">
    <div class="management-header">
        <div>
            <span class="management-kicker">Nuevo registro</span>
            <h1>Registrar área</h1>
            <p>Completa los datos y guarda el registro.</p>
        </div>
        <a href="{{ route('area.index') }}" class="management-secondary-action">Volver a áreas</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*" required>
                </div>
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Guardar área</button>
                <a href="{{ route('area.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
