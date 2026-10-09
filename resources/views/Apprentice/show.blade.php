@extends('layouts.app')

@section('content')
@php
    $course = $apprentice['course'] ?? null;
    $computer = $apprentice['computer'] ?? null;
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $apprentice['name'] ?? 'Aprendiz' }}</h1>
            <p>Detalle del aprendiz y sus relaciones actuales.</p>
        </div>
        <a href="{{ route('apprentice.index') }}" class="management-secondary-action">Volver a aprendices</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">{{ strtoupper(substr(($apprentice['name'] ?? 'A'), 0, 1)) }}</div>
            <div>
                <span class="detail-label">Aprendiz registrado</span>
                <h2>{{ $apprentice['name'] ?? '—' }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($apprentice['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Correo</span>
                <strong>{{ $apprentice['email'] ?? 'Sin correo' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Celular</span>
                <strong>{{ $apprentice['cell_number'] ?? 'Sin celular' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Curso</span>
                <strong>{{ $course['course_number'] ?? 'Sin curso' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Computador</span>
                <strong>{{ $computer['brand'] ?? 'Sin computador' }}</strong>
            </div>
        </div>

        <div class="detail-actions">
            <a href="{{ route('apprentice.edit', $apprentice['id']) }}" class="management-primary-action">Editar aprendiz</a>
            <form action="{{ route('apprentice.destroy', $apprentice['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar este aprendiz?')">Eliminar aprendiz</button>
            </form>
        </div>
    </section>
</main>
@endsection
