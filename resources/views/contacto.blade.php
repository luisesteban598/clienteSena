@extends('layouts.app')

@section('content')
<div class="management-page">
    <section class="management-card">
        <div class="management-header" style="padding: 2rem 1.5rem 1rem; margin-bottom: 0;">
            <div>
                <span class="management-kicker">Atención</span>
                <h1>Contacto</h1>
                <p>Estamos atentos para responder dudas y apoyar procesos institucionales.</p>
            </div>
        </div>

        <div class="p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="management-card" style="padding: 1.25rem; border: 1px solid #e1e5de;">
                        <h3 class="mb-3">Información</h3>
                        <p class="mb-2"><strong>Correo:</strong> contacto@clientesena.edu.co</p>
                        <p class="mb-2"><strong>Teléfono:</strong> (57) 000 000 0000</p>
                        <p class="mb-0"><strong>Dirección:</strong> SENA, Regional / Centro de formación</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="management-card" style="padding: 1.25rem; border: 1px solid #e1e5de;">
                        <h3 class="mb-3">Horario</h3>
                        <p class="mb-2">Lunes a viernes</p>
                        <p class="mb-0">8:00 a.m. - 6:00 p.m.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
