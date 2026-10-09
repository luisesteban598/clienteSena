{{-- Esta barra conecta las secciones públicas y se adapta a pantallas pequeñas. --}}
<nav class="navbar navbar-expand-xl">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
           
            <span>ClienteSena</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav ms-auto align-items-xl-center gap-xl-1 py-3 py-xl-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('news.public') }}">Noticias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('curso.index') }}">Cursos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('area.index') }}">Áreas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('computer.index') }}">Computadores</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('trainingCenter.index') }}">Centros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('teacher.index') }}">Instructores</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
                
            </ul>
        </div>
    </div>
</nav>