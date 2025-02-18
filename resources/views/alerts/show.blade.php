@extends('layouts.app')

@section('title', __('alerts.titulo.guia'))

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4"></h1>

 
    <p><strong>{{ __('alerts.fields.patientId') }}:</strong> {{ $alert->Patient->name }}</p>
    <p><strong>{{ __('alerts.fields.type') }}:</strong> {{ $alert->type }}</p>
    <p><strong>{{ __('alerts.fields.subType') }}:</strong> {{ $alert->subType }}</p>
    <p><strong>{{ __('alerts.fields.startDate') }}:</strong> {{ $alert->startDate }}</p>
    @if ($alert->isRecurring)
    <p><strong>{{ __('alerts.fields.isRecurring') }}:</strong> {{ __('alerts.fields.isRecurring') }}</p>
@endif

    <p><strong>{{ __('alerts.fields.description') }}:</strong> {{ $alert->description }}</p>
    <p><strong>{{ __('alerts.fields.recurrenceType') }}:</strong> {{ $alert->recurrenceType }}</p>

   


    <!-- Enlace para volver a la lista de pacientes -->
    <a href="{{ route('alerts.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection
