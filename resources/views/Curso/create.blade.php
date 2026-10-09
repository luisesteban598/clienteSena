@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Nuevo registro</span>
            <h1>Registrar curso</h1>
            <p>Completa los datos y guarda el registro.</p>
        </div>
        <a href="{{ route('curso.index') }}" class="management-secondary-action">Volver a cursos</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('curso.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="course_number">Número del curso</label>
                <input type="text" id="course_number" name="course_number" value="{{ old('course_number') }}" required>
                @error('course_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="day">Fecha</label>
                <input type="date" id="day" name="day" value="{{ old('day') }}" required>
                @error('day')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="area_id">Área</label>
                <select id="area_id" name="area_id" required>
                    <option value="">Selecciona un área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area['id'] }}" {{ old('area_id') == $area['id'] ? 'selected' : '' }}>
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
                        <option value="{{ $trainingCenter['id'] }}" {{ old('training_center_id') == $trainingCenter['id'] ? 'selected' : '' }}>
                            {{ $trainingCenter['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('training_center_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Guardar curso</button>
                <a href="{{ route('curso.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
