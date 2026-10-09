@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Nuevo registro</span>
            <h1>Registrar aprendiz</h1>
            <p>Completa los datos y guarda el registro.</p>
        </div>
        <a href="{{ route('apprentice.index') }}" class="management-secondary-action">Volver a aprendices</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('apprentice.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="cell_number">Celular</label>
                <input type="text" id="cell_number" name="cell_number" value="{{ old('cell_number') }}" placeholder="3001234567" required>
                @error('cell_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_id">Curso</label>
                <select id="course_id" name="course_id" required>
                    <option value="">Selecciona un curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course['id'] }}" {{ old('course_id') == $course['id'] ? 'selected' : '' }}>
                            {{ $course['course_number'] ?? 'Curso' }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="computer_id">Computador</label>
                <select id="computer_id" name="computer_id" required>
                    <option value="">Selecciona un computador</option>
                    @foreach ($computers as $computer)
                        <option value="{{ $computer['id'] }}" {{ old('computer_id') == $computer['id'] ? 'selected' : '' }}>
                            {{ $computer['brand'] ?? 'Computador' }} - {{ $computer['number'] ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('computer_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Guardar aprendiz</button>
                <a href="{{ route('apprentice.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
