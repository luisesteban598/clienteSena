@extends('layouts.app')

@section('content')
@php
    $apprentice = $computer['apprentice'] ?? null;
@endphp
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de recurso</span>
            <h1>Equipo {{ $computer['number'] }}</h1>
            <p>Detalle del computador y su asignación actual.</p>
        </div>
        <a href="{{ route('computer.index') }}" class="management-secondary-action">Volver a computadores</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">C</div>
            <div>
                <span class="detail-label">Computador registrado</span>
                <h2>{{ $computer['brand'] }} · Equipo {{ $computer['number'] }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($computer['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Número</span>
                <strong>{{ $computer['number'] }}</strong>
            </div>
            <div class="detail-stat">
                <span>Marca</span>
                <strong>{{ $computer['brand'] }}</strong>
            </div>
            <div class="detail-stat">
                <span>Estado</span>
                <strong>{{ $apprentice ? 'Asignado' : 'Disponible' }}</strong>
            </div>
        </div>

        <div class="related-details">
            <section class="related-section">
                <div class="related-heading">
                    <div>
                        <span class="detail-label">Asignación</span>
                        <h3>Aprendiz responsable</h3>
                    </div>
                </div>

                @if ($apprentice)
                <div class="related-item">
                    <span class="related-icon related-icon-orange">A</span>
                    <div>
                        <strong>{{ $apprentice['name'] ?? '—' }}</strong>
                        <span>{{ $apprentice['email'] ?? '' }}</span>
                    </div>
                </div>
                @else
                <p class="related-empty">Este computador está disponible.</p>
                @endif
            </section>
        </div>

        <div class="detail-actions">
            <a href="{{ route('computer.edit', $computer['id']) }}" class="management-primary-action">Editar computador</a>
            <form action="{{ route('computer.destroy', $computer['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar este computador?')">Eliminar computador</button>
            </form>
        </div>
    </section>
</main>
@endsection
