@extends('layouts.app')

@section('content')
@php
    $area = $teacher['area'] ?? null;
    $trainingCenter = $teacher['training_center'] ?? null;
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $teacher['name'] ?? 'Instructor' }}</h1>
            <p>Detalle del instructor y sus relaciones actuales.</p>
        </div>
        <a href="{{ route('teacher.index') }}" class="management-secondary-action">Volver a instructores</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">{{ strtoupper(substr(($teacher['name'] ?? 'I'), 0, 1)) }}</div>
            <div>
                <span class="detail-label">Instructor registrado</span>
                <h2>{{ $teacher['name'] ?? '—' }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($teacher['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Correo</span>
                <strong>{{ $teacher['email'] ?? 'Sin correo' }}</strong>
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
            <a href="{{ route('teacher.edit', $teacher['id']) }}" class="management-primary-action">Editar instructor</a>
            <form action="{{ route('teacher.destroy', $teacher['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar este instructor?')">Eliminar instructor</button>
            </form>
        </div>
    </section>
</main>
@endsection
