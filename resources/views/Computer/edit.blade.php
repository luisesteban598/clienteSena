@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Edición de registro</span>
            <h1>Editar computador</h1>
            <p>Registro #{{ str_pad($computer['id'], 3, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('computer.index') }}" class="management-secondary-action">Volver a computadores</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('computer.update', $computer['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="number">Número</label>
                <input type="number" id="number" name="number" value="{{ old('number', $computer['number'] ?? '') }}" required>
                @error('number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="brand">Marca</label>
                <input type="text" id="brand" name="brand" value="{{ old('brand', $computer['brand'] ?? '') }}" required>
                @error('brand')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Actualizar</button>
                <a href="{{ route('computer.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
