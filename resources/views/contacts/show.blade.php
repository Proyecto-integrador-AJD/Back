@extends('layouts.app')

@section('title', __('contacts.titulo.guia'))

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4"></h1>

 
    <p><strong>{{ __('contacts.fields.name') }}:</strong> {{ $contact->name }}</p>
    <p><strong>{{ __('contacts.fields.lastName') }}:</strong> {{ $contact->lastName }}</p>
    <p><strong>{{ __('contacts.fields.email') }}:</strong> {{ $contact->email }}</p>
    <p><strong>{{ __('contacts.fields.prefix') }}:</strong> {{ $contact->prefix }}</p>
    <p><strong>{{ __('contacts.fields.phone') }}:</strong> {{ $contact->phone }}</p>
    <p><strong>{{ __('contacts.fields.pacientId') }}:</strong> {{ $contact->Patient->name }}</p>
    <p><strong>{{ __('contacts.fields.relationship') }}:</strong> {{ $contact->relationship }}</p>

   


    <!-- Enlace para volver a la lista de pacientes -->
    <a href="{{ route('contacts.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection