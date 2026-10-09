@extends('layouts.app')

@section('content')
<main class="management-page">
    @include('includes.flash')

    <div class="management-header">
        <div>
            <span class="management-kicker">Edición de registro</span>
            <h1>Editar noticia</h1>
            <p>Actualiza la información de la noticia.</p>
        </div>
        <a href="{{ route('news.index') }}" class="management-secondary-action">Volver a noticias</a>
    </div>

    <section class="form-management-card">
        <form action="{{ route('news.update', $news['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news['title'] ?? '') }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary">Resumen</label>
                <textarea id="summary" name="summary" rows="3" required>{{ old('summary', $news['summary'] ?? '') }}</textarea>
                @error('summary')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea id="content" name="content" rows="6" required>{{ old('content', $news['content'] ?? '') }}</textarea>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Imagen URL</label>
                <input type="url" id="image" name="image" value="{{ old('image', $news['image'] ?? '') }}" placeholder="https://ejemplo.com/imagen.jpg">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_published">¿Publicar?</label>
                <select id="is_published" name="is_published">
                    <option value="0" {{ old('is_published', $news['is_published'] ?? 0) == '0' ? 'selected' : '' }}>Borrador</option>
                    <option value="1" {{ old('is_published', $news['is_published'] ?? 0) == '1' ? 'selected' : '' }}>Publicada</option>
                </select>
            </div>

            <div class="detail-actions" style="padding-left:0;background:transparent;">
                <button type="submit" class="management-primary-action">Actualizar noticia</button>
                <a href="{{ route('news.index') }}" class="management-secondary-action">Cancelar</a>
            </div>
        </form>
    </section>
</main>
@endsection
