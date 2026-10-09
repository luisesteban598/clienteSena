@extends('layouts.app')

@section('content')
@php
    $area = $course['area'] ?? null;
    $trainingCenter = $course['training_center'] ?? null;
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $course['course_number'] ?? 'Curso' }}</h1>
            <p>Detalle del curso y sus relaciones actuales.</p>
        </div>
        <a href="{{ route('curso.index') }}" class="management-secondary-action">Volver a cursos</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">{{ strtoupper(substr(($course['course_number'] ?? 'C'), 0, 1)) }}</div>
            <div>
                <span class="detail-label">Curso registrado</span>
                <h2>{{ $course['course_number'] ?? '—' }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($course['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Fecha</span>
                <strong>{{ !empty($course['day']) ? \Carbon\Carbon::parse($course['day'])->format('d/m/Y') : 'Sin fecha' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Área</span>
                <strong>{{ $area['name'] ?? 'Sin área' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Centro</span>
                <strong>{{ $trainingCenter['name'] ?? 'Sin centro' }}</strong>
            </div>
        </div>

        <div class="detail-actions">
            <a href="{{ route('curso.edit', $course['id']) }}" class="management-primary-action">Editar curso</a>
            <form action="{{ route('curso.destroy', $course['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar este curso?')">Eliminar curso</button>
            </form>
        </div>
    </section>
</main>
@endsection
