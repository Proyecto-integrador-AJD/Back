@extends('layouts.app')
@section('title', __('zones.titulo.guia'))
@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">{{ $zone->name }}</h1>
    <p><strong>Nombre:</strong> {{ $zone->name }}</p>
    <p><strong>Descripcion:</strong> {{ $zone->description }}</p>
    <p><strong>Ubicacion:</strong> {{ $zone->location }}</p>
    <a href="{{ route('zones.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection


