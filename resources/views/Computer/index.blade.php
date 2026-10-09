@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Recursos tecnológicos</span>
            <h1>Computadores</h1>
            <p>Consulta y administra los equipos disponibles para la formación.</p>
        </div>
        <a href="{{ route('computer.create') }}" class="management-primary-action">
            <span>+</span> Nuevo computador
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($computers) }}</strong>
                <span> {{ count($computers) === 1 ? 'equipo registrado' : 'equipos registrados' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="computerSearch" placeholder="Buscar por número o marca..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Número</th>
                        <th scope="col">Marca</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($computers as $computer)
                    <tr class="filter-row" data-search="{{ strtolower($computer['number'] . ' ' . $computer['brand']) }}">
                        <td><span class="record-id">#{{ str_pad($computer['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>Equipo {{ $computer['number'] }}</strong></td>
                        <td>{{ $computer['brand'] }}</td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('computer.show', $computer['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('computer.edit', $computer['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('computer.destroy', $computer['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar este computador?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="management-empty">Todavía no hay computadores registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos computadores con ese criterio.</p>
    </section>
</main>

<script>
    // Filtra la tabla mientras se escribe.
    document.getElementById('computerSearch')?.addEventListener('input', (event) => {
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
