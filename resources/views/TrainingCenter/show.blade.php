@extends('layouts.app')

@section('content')
@php
    // La API devuelve las relaciones con las claves "course" y "teacher".
    $courses  = $trainingCenter['course']  ?? [];
    $teachers = $trainingCenter['teacher'] ?? [];
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $trainingCenter['name'] }}</h1>
            <p>Detalle del centro de formación y sus relaciones actuales.</p>
        </div>
        <a href="{{ route('trainingCenter.index') }}" class="management-secondary-action">Volver a centros</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">{{ strtoupper(substr($trainingCenter['name'], 0, 1)) }}</div>
            <div>
                <span class="detail-label">Centro registrado</span>
                <h2>{{ $trainingCenter['name'] }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($trainingCenter['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Cursos asociados</span>
                <strong>{{ count($courses) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Instructores asociados</span>
                <strong>{{ count($teachers) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Ubicación</span>
                <strong>{{ $trainingCenter['location'] }}</strong>
            </div>
        </div>

        <div class="related-details">
            <section class="related-section">
                <div class="related-heading">
                    <div>
                        <span class="detail-label">Oferta académica</span>
                        <h3>Cursos asociados</h3>
                    </div>
                    <span class="related-count">{{ count($courses) }}</span>
                </div>

                @forelse ($courses as $item)
                <div class="related-item">
                    <span class="related-icon">C</span>
                    <div>
                        <strong>Curso {{ $item['course_number'] ?? '—' }}</strong>
                        <span>{{ !empty($item['day'] ?? null) ? \Carbon\Carbon::parse($item['day'] ?? null)->format('d/m/Y') : 'Sin fecha registrada' }}</span>
                    </div>
                </div>
                @empty
                <p class="related-empty">No hay cursos asociados.</p>
                @endforelse
            </section>

            <section class="related-section">
                <div class="related-heading">
                    <div>
                        <span class="detail-label">Equipo humano</span>
                        <h3>Instructores asociados</h3>
                    </div>
                    <span class="related-count">{{ count($teachers) }}</span>
                </div>

                @forelse ($teachers as $item)
                <div class="related-item">
                    <span class="related-icon related-icon-orange">I</span>
                    <div>
                        <strong>{{ $item['name'] ?? '—' }}</strong>
                        <span>{{ $item['email'] ?? '' }}</span>
                    </div>
                </div>
                @empty
                <p class="related-empty">No hay instructores asociados.</p>
                @endforelse
            </section>
        </div>

        <div class="detail-actions">
            <a href="{{ route('trainingCenter.edit', $trainingCenter['id']) }}" class="management-primary-action">Editar centro</a>
            <form action="{{ route('trainingCenter.destroy', $trainingCenter['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar este centro?')">Eliminar centro</button>
            </form>
        </div>
    </section>
</main>
@endsection
