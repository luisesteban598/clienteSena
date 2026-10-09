@extends('layouts.app')

@section('content')
<div class="management-page">
    <section class="management-card">
        <div class="management-header" style="padding: 2rem 1.5rem 1rem; margin-bottom: 0;">
            <div>
                <span class="management-kicker">ClienteSena</span>
                <h1>Nosotros</h1>
                <p>Conoce la misión, visión y propósito del proyecto.</p>
            </div>
        </div>

        <div class="p-4">
            <p>ClienteSena es una plataforma orientada a la gestión de información institucional del SENA, diseñada para consultar y administrar registros de áreas, centros de formación, computadores, instructores, cursos y noticias desde un cliente Laravel que consume la API administrativa.</p>

            <div class="row g-4 mt-1">
                <div class="col-md-6">
                    <div class="management-card" style="padding: 1.25rem; border: 1px solid #e1e5de;">
                        <h3 class="mb-3">Misión</h3>
                        <p class="mb-0">Facilitar la administración digital de la información académica y operativa del SENA, mejorando el acceso y la organización de los datos.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="management-card" style="padding: 1.25rem; border: 1px solid #e1e5de;">
                        <h3 class="mb-3">Visión</h3>
                        <p class="mb-0">Ser una herramienta cercana, funcional y confiable para la gestión institucional, apoyando procesos académicos y administrativos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
