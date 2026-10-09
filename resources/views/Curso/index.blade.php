@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Gestión curricular</span>
            <h1>Cursos</h1>
            <p>Administra los cursos de la institución.</p>
        </div>
        <a href="{{ route('curso.create') }}" class="management-primary-action">
            <span>+</span> Nuevo curso
        </a>
    </div>

    <section class="management-card">
        <div class="management-toolbar">
            <div>
                <strong>{{ count($courses) }}</strong>
                <span> {{ count($courses) === 1 ? 'curso registrado' : 'cursos registrados' }}</span>
            </div>
            <label class="management-search">
                <span aria-hidden="true">⌕</span>
                <input type="search" id="cursoSearch" placeholder="Buscar por número o fecha..." aria-label="Buscar en la lista">
            </label>
        </div>

        <div class="management-table-wrap">
            <table class="management-table">
                <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Número del curso</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Área</th>
                        <th scope="col">Centro</th>
                        <th scope="col" class="management-actions-heading">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                    <tr class="filter-row" data-search="{{ strtolower(($course['course_number'] ?? '') . ' ' . ($course['day'] ?? '')) }}">
                        <td><span class="record-id">#{{ str_pad($course['id'], 3, '0', STR_PAD_LEFT) }}</span></td>
                        <td><strong>{{ $course['course_number'] ?? '—' }}</strong></td>
                        <td>{{ !empty($course['day']) ? \Carbon\Carbon::parse($course['day'])->format('d/m/Y') : 'Sin fecha' }}</td>
                        <td>{{ $course['area']['name'] ?? 'Sin área' }}</td>
                        <td>{{ $course['training_center']['name'] ?? 'Sin centro' }}</td>
                        <td>
                            <div class="management-actions">
                                <a href="{{ route('curso.show', $course['id']) }}" class="table-action table-action-view">Ver</a>
                                <a href="{{ route('curso.edit', $course['id']) }}" class="table-action table-action-edit">Editar</a>
                                <form action="{{ route('curso.destroy', $course['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action table-action-delete"
                                        onclick="return confirm('¿Deseas eliminar este curso?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="management-empty">Todavía no hay cursos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="management-no-results" hidden>No encontramos cursos con ese criterio.</p>
    </section>
</main>

<script>
    document.getElementById('cursoSearch')?.addEventListener('input', (event) => {
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
