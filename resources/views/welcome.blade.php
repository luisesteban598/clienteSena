@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="management-card">
            <div class="management-header" style="padding: 2rem 1.5rem 1rem; margin-bottom: 0;">
                <div>
                    <span class="management-kicker">ClienteSena</span>
                    <h1>Bienvenido</h1>
                    <p>Panel administrativo para gestionar áreas, computadores y centros de formación.</p>
                </div>
            </div>
            <div class="p-4">
                <p>Selecciona una opción desde el menú para continuar.</p>
                <div class="d-flex flex-wrap gap-3 mt-3">
                    <a href="{{ route('area.index') }}" class="management-primary-action">Áreas</a>
                    <a href="{{ route('computer.index') }}" class="management-primary-action">Computadores</a>
                    <a href="{{ route('trainingCenter.index') }}" class="management-primary-action">Centros</a>
                    <a href="{{ route('teacher.index') }}" class="management-primary-action">Instructores</a>
                    <a href="{{ route('curso.index') }}" class="management-primary-action">Cursos</a>
                    <a href="{{ route('news.public') }}" class="management-primary-action">Noticias</a>
                </div>
            </div>
        </div>
    </div>
@endsection
