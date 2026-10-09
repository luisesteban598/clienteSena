@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Gestión de aprendices</span>
            <h1>Aprendices</h1>
            <p>Administra los aprendices de la institución.</p>
        </div>
        <a href="{{ route('apprentice.create') }}" class="management-primary-action">
            <span>+</span> Nuevo aprendiz
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($apprentices) }}</strong>
                <span> {{ count($apprentices) === 1 ? 'aprendiz registrado' : 'aprendices registrados' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="apprenticeSearch" placeholder="Buscar por nombre o correo..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Computador</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($apprentices as $apprentice)
                    <tr class="filter-row" data-search="{{ strtolower(($apprentice['name'] ?? '') . ' ' . ($apprentice['email'] ?? '')) }}">
                        <td><span class="record-id">#{{ str_pad($apprentice['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>{{ $apprentice['name'] ?? '—' }}</strong></td>
                        <td>{{ $apprentice['email'] ?? '—' }}</td>
                        <td>{{ $apprentice['cell_number'] ?? '—' }}</td>
                        <td>{{ $apprentice['course']['course_number'] ?? 'Sin curso' }}</td>
                        <td>{{ $apprentice['computer']['brand'] ?? 'Sin computador' }}</td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('apprentice.show', $apprentice['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('apprentice.edit', $apprentice['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('apprentice.destroy', $apprentice['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar este aprendiz?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="management-empty">Todavía no hay aprendices registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos aprendices con ese criterio.</p>
    </section>
</main>

<script>
    document.getElementById('apprenticeSearch')?.addEventListener('input', (event) => {
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
