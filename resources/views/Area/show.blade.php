@extends('layouts.app')

@section('content')
@php
    $courses  = $area['courses']  ?? [];
    $teachers = $area['teachers'] ?? [];
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $area['name'] }}</h1>
            <p>Detalle del área de formación y sus relaciones actuales.</p>
        </div>
        <a href="{{ route('area.index') }}" class="management-secondary-action">Volver a áreas</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">{{ strtoupper(substr($area['name'], 0, 1)) }}</div>
            <div>
                <span class="detail-label">Área registrada</span>
                <h2>{{ $area['name'] }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($area['id'], 3, '0', STR_PAD_LEFT) }}</strong>
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
                <span>Fecha de creación</span>
                <strong>{{ !empty($area['created_at']) ? \Carbon\Carbon::parse($area['created_at'])->format('d/m/Y') : 'Sin fecha' }}</strong>
            </div>
        </div>

        <div class="related-details">
            <section class="related-section">
                <div class="related-heading">
                    <div>
                        <span class="detail-label">Formación</span>
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
                <p class="related-empty">No hay cursos asociados a esta área.</p>
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
                <p class="related-empty">No hay instructores asociados a esta área.</p>
                @endforelse
            </section>
        </div>

        <div class="detail-actions">
            <a href="{{ route('area.edit', $area['id']) }}" class="management-primary-action">Editar área</a>
            <form action="{{ route('area.destroy', $area['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar esta área?')">Eliminar área</button>
            </form>
        </div>
    </section>
</main>
@endsection
