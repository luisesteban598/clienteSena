@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Gestión docente</span>
            <h1>Instructores</h1>
            <p>Administra los instructores de la institución.</p>
        </div>
        <a href="{{ route('teacher.create') }}" class="management-primary-action">
            <span>+</span> Nuevo instructor
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($teachers) }}</strong>
                <span> {{ count($teachers) === 1 ? 'instructor registrado' : 'instructores registrados' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="teacherSearch" placeholder="Buscar por nombre o correo..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Área</th>
                        <th scope="col">Centro</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                    <tr class="filter-row" data-search="{{ strtolower(($teacher['name'] ?? '') . ' ' . ($teacher['email'] ?? '')) }}">
                        <td><span class="record-id">#{{ str_pad($teacher['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>{{ $teacher['name'] ?? '—' }}</strong></td>
                        <td>{{ $teacher['email'] ?? '—' }}</td>
                        <td>{{ $teacher['area']['name'] ?? 'Sin área' }}</td>
                        <td>{{ $teacher['training_center']['name'] ?? 'Sin centro' }}</td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('teacher.show', $teacher['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('teacher.edit', $teacher['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('teacher.destroy', $teacher['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar este instructor?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="management-empty">Todavía no hay instructores registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos instructores con ese criterio.</p>
    </section>
</main>

<script>
    document.getElementById('teacherSearch')?.addEventListener('input', (event) => {
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
