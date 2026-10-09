@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Gestión académica</span>
            <h1>Áreas de formación</h1>
            <p>Administra las áreas que hacen parte de la oferta institucional.</p>
        </div>
        <a href="{{ route('area.create') }}" class="management-primary-action">
            <span>+</span> Nueva área
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($areas) }}</strong>
                <span> {{ count($areas) === 1 ? 'área registrada' : 'áreas registradas' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="areaSearch" placeholder="Buscar por nombre..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre del área</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areas as $area)
                    <tr class="filter-row" data-search="{{ strtolower($area['name']) }}">
                        <td><span class="record-id">#{{ str_pad($area['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>{{ $area['name'] }}</strong></td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('area.show', $area['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('area.edit', $area['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('area.destroy', $area['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar esta área?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="management-empty">Todavía no hay áreas registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos áreas con ese criterio.</p>
    </section>
</main>

<script>
    // Filtra la tabla mientras se escribe.
    document.getElementById('areaSearch')?.addEventListener('input', (event) => {
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
