@extends('layouts.app')
@section('title', __('users.titulo.guia'))
@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">{{ $user->name }}</h1>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Apellido:</strong> {{ $user->lastName }}</p>
    <p><strong>Correo:</strong> {{ $user->email }}</p>
    <p><strong>Contraseña:</strong> {{ $user->password }}</p>
    <p><strong>Prefijo:</strong> {{ $user->prefix }}</p>
    <p><strong>Telefono:</strong> {{ $user->phone }}</p>
    <p><strong>Fecha de Inicio:</strong> {{ $user->dateHire }}</p>
    <p><strong>Nombre de Usuario:</strong> {{ $user->username }}</p>



    <a href="{{ route('users.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection