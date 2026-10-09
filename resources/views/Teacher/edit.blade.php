@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Edición de registro</span>
            <h1>Editar instructor</h1>
            <p>Actualiza la información del instructor.</p>
        </div>
        <a href="{{ route('teacher.index') }}" class="management-secondary-action">Volver a instructores</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('teacher.update', $teacher['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $teacher['name'] ?? '') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="{{ old('email', $teacher['email'] ?? '') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="area_id">Área</label>
                <select id="area_id" name="area_id" required>
                    <option value="">Selecciona un área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area['id'] }}" {{ old('area_id', $teacher['area_id'] ?? '') == $area['id'] ? 'selected' : '' }}>
                            {{ $area['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('area_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="training_center_id">Centro de formación</label>
                <select id="training_center_id" name="training_center_id" required>
                    <option value="">Selecciona un centro</option>
                    @foreach ($trainingCenters as $trainingCenter)
                        <option value="{{ $trainingCenter['id'] }}" {{ old('training_center_id', $teacher['training_center_id'] ?? '') == $trainingCenter['id'] ? 'selected' : '' }}>
                            {{ $trainingCenter['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('training_center_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Actualizar instructor</button>
                <a href="{{ route('teacher.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
