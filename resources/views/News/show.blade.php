@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Consulta de registro</span>
            <h1>{{ $news['title'] ?? 'Noticia' }}</h1>
            <p>Detalle de la noticia y su contenido.</p>
        </div>
        <a href="{{ route('news.index') }}" class="management-secondary-action">Volver a noticias</a>
    </div>

    <section class="detail-card">
        <div class="detail-card-heading">
            <div class="detail-record-icon">N</div>
            <div>
                <span class="detail-label">Noticia registrada</span>
                <h2>{{ $news['title'] ?? '—' }}</h2>
            </div>
        </div>

        <div class="detail-stats">
            <div class="detail-stat">
                <span>Identificador</span>
                <strong>#{{ str_pad($news['id'], 3, '0', STR_PAD_LEFT) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Estado</span>
                <strong>{{ !empty($news['is_published']) ? 'Publicada' : 'Borrador' }}</strong>
            </div>
            <div class="detail-stat">
                <span>Resumen</span>
                <strong>{{ Str::limit($news['summary'] ?? 'Sin resumen', 40) }}</strong>
            </div>
            <div class="detail-stat">
                <span>Fecha</span>
                <strong>{{ !empty($news['published_at']) ? \Carbon\Carbon::parse($news['published_at'])->format('d/m/Y') : 'Sin fecha' }}</strong>
            </div>
        </div>

        <div class="related-details">
            <section class="related-section">
                <div class="related-heading">
                    <div>
                        <span class="detail-label">Contenido</span>
                        <h3>Detalle</h3>
                    </div>
                </div>

                @if (!empty($news['image']))
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ $news['image'] }}" alt="{{ $news['title'] ?? 'Noticia' }}" style="max-width: 100%; border-radius: 12px;">
                    </div>
                @endif

                <p>{{ $news['content'] ?? 'Sin contenido disponible.' }}</p>
            </section>
        </div>

        <div class="detail-actions">
            <a href="{{ route('news.edit', $news['id']) }}" class="management-primary-action">Editar noticia</a>
            <form action="{{ route('news.destroy', $news['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="table-action table-action-delete"
                    onclick="return confirm('¿Deseas eliminar esta noticia?')">Eliminar noticia</button>
            </form>
        </div>
    </section>
</main>
@endsection
