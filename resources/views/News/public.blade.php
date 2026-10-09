@extends('layouts.app')

@section('content')
<main class="management-page">
    <div class="management-header">
        <div>
            <span class="management-kicker">Portal institucional</span>
            <h1>Noticias</h1>
            <p>Conoce las publicaciones más recientes.</p>
        </div>
    </div>

    <section class="management-card" style="padding: 1.5rem;">
        @forelse ($news as $item)
            <article style="padding: 1.2rem 0; border-bottom: 1px solid rgba(0,0,0,0.08);">
                @if (!empty($item['image']))
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] ?? 'Noticia' }}" style="max-width: 100%; border-radius: 12px; margin-bottom: 1rem;">
                @endif
                <h2 style="margin-bottom: .5rem;">{{ $item['title'] ?? 'Sin título' }}</h2>
                <p style="margin-bottom: .6rem; color: #506070;">{{ $item['summary'] ?? 'Sin resumen' }}</p>
                <p>{{ Str::limit($item['content'] ?? 'Sin contenido', 180) }}</p>
            </article>
        @empty
            <p>No hay noticias disponibles por el momento.</p>
        @endforelse
    </section>
</main>
@endsection
