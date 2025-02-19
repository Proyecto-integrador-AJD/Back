@extends('layouts.app')

@section('title', __('calls.titulo.guia'))

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4"></h1>

 
    <p><strong>{{ __('calls.fields.patientId') }}:</strong> {{ $call->Patient->name }}</p>
    <p><strong>{{ __('calls.fields.userId') }}:</strong> {{ $call->User->name }}</p>
    <p><strong>{{ __('calls.fields.date') }}:</strong> {{ $call->date }}</p>
    <p><strong>{{ __('calls.fields.incoming') }}:</strong> 
    {{ $call->incoming == 1 ? __('calls.fields.incoming_option_1') : __('calls.fields.incoming_option_0') }}
    </p>
    <p><strong>{{ __('calls.fields.type') }}:</strong> {{ $call->type }}</p>
    <p><strong>{{ __('calls.fields.subType') }}:</strong> {{ $call->subType }}</p>
    <p><strong>{{ __('calls.fields.duration') }}:</strong> {{ $call->duration }}</p>
    <p><strong>{{ __('calls.fields.description') }}:</strong> {{ $call->description }}</p>

   


    <!-- Enlace para volver a la lista de pacientes -->
    <a href="{{ route('patients.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection
