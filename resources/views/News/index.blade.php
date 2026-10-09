@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Gestión editorial</span>
            <h1>Noticias</h1>
            <p>Administra las noticias del portal institucional.</p>
        </div>
        <a href="{{ route('news.create') }}" class="management-primary-action">
            <span>+</span> Nueva noticia
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($news) }}</strong>
                <span> {{ count($news) === 1 ? 'noticia registrada' : 'noticias registradas' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="newsSearch" placeholder="Buscar por título..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Título</th>
                        <th scope="col">Resumen</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                    <tr class="filter-row" data-search="{{ strtolower($item['title'] ?? '') }}">
                        <td><span class="record-id">#{{ str_pad($item['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>{{ $item['title'] ?? '—' }}</strong></td>
                        <td>{{ $item['summary'] ?? 'Sin resumen' }}</td>
                        <td>{{ !empty($item['is_published']) ? 'Publicada' : 'Borrador' }}</td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('news.show', $item['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('news.edit', $item['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('news.destroy', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar esta noticia?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="management-empty">Todavía no hay noticias registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos noticias con ese criterio.</p>
    </section>
</main>

<script>
    document.getElementById('newsSearch')?.addEventListener('input', (event) => {
        const term = event.target.value.trim().toLowerCase();
        const rows = document.querySelectorAll('.filter-row');
        let visible = 0;

        rows.forEach((row) => {
            const match = row.dataset.search.includes(term);
            row.hidden = !match;
            if (match) visible++;
        });

        document.querySelector('.management-no-results').hidden = visible !== 0;
    });
</script>
@endsection
