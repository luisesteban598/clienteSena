@extends('layouts.app')

@section('content')

<h1>Editar centro de formación</h1>

<form action="{{route('trainingCenter.update',$trainingCenter['id'] )}}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')

<label>
    Nombre:
    <br>
    <input type="text" name="name" value="{{ old('name', $trainingCenter['name'] ?? '') }}" >
</label>

<label>
    ubicacion:
    <br>
    <input type="text" name="location" value="{{ old('location', $trainingCenter['location'] ?? '') }}" >
</label>

<br>

<br><br>
<button type="submit" class="btn btn-outline-success btn-sm">Enviar Formulario:</button>
<br><br>
</form>

@endsection()