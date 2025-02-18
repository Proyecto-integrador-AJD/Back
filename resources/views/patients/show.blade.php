@extends('layouts.app')

@section('title', __('patients.titulo.guia'))

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">{{ $patient->name }} {{ $patient->lastName }}</h1>

    <!-- Información básica -->
    <p><strong>{{ __('patients.fields.name') }}:</strong> {{ $patient->name }}</p>
    <p><strong>{{ __('patients.fields.lastName') }}:</strong> {{ $patient->lastName }}</p>
    <p><strong>{{ __('patients.fields.birthDate') }}:</strong> {{ $patient->birthDate }}</p>

    <!-- Dirección -->
    <p><strong>{{ __('patients.fields.addressStreet') }}:</strong> {{ $patient->addressStreet }}</p>
    <p><strong>{{ __('patients.fields.addressNumber') }}:</strong> {{ $patient->addressNumber }}</p>
    <p><strong>{{ __('patients.fields.addressFloor') }}:</strong> {{ $patient->addressFloor }}</p>
    <p><strong>{{ __('patients.fields.addressDoor') }}:</strong> {{ $patient->addressDoor }}</p>
    <p><strong>{{ __('patients.fields.addressPostalCode') }}:</strong> {{ $patient->addressPostalCode }}</p>
    <p><strong>{{ __('patients.fields.addressCity') }}:</strong> {{ $patient->addressCity }}</p>
    <p><strong>{{ __('patients.fields.addressProvince') }}:</strong> {{ $patient->addressProvince }}</p>
    <p><strong>{{ __('patients.fields.addressCountry') }}:</strong> {{ $patient->addressCountry }}</p>

    <!-- Información adicional -->
    <p><strong>{{ __('patients.fields.dni') }}:</strong> {{ $patient->dni }}</p>
    <p><strong>{{ __('patients.fields.healthCardNumber') }}:</strong> {{ $patient->healthCardNumber }}</p>
    <p><strong>{{ __('patients.fields.prefix') }}:</strong> {{ $patient->prefix }}</p>
    <p><strong>{{ __('patients.fields.phone') }}:</strong> {{ $patient->phone }}</p>
    <p><strong>{{ __('patients.fields.email') }}:</strong> {{ $patient->email }}</p>

    <!-- Lenguas -->
    <p><strong>{{ __('patients.fields.language') }}:</strong> 
        @foreach ($patient->language as $lang)
            {{ $lang }},
        @endforeach
    </p>

    <!-- Zona -->
    <p><strong>{{ __('patients.fields.zoneId') }}:</strong> {{ $patient->zone->name }}</p>

    <!-- Situación personal y familiar -->
    <p><strong>{{ __('patients.fields.situationPersonalFamily') }}:</strong> {{ $patient->situationPersonalFamily }}</p>

    <!-- Situación de salud -->
    <p><strong>{{ __('patients.fields.healthSituation') }}:</strong> {{ $patient->healthSituation }}</p>

    <!-- Situación de vivienda -->
    <p><strong>{{ __('patients.fields.housingSituationType') }}:</strong> {{ $patient->housingSituationType }}</p>
    <p><strong>{{ __('patients.fields.housingSituationStatus') }}:</strong> {{ $patient->housingSituationStatus }}</p>
    <p><strong>{{ __('patients.fields.housingSituationNumberOfRooms') }}:</strong> {{ $patient->housingSituationNumberOfRooms }}</p>
    <p><strong>{{ __('patients.fields.housingSituationLocation') }}:</strong> {{ $patient->housingSituationLocation }}</p>

    <!-- Autonomía personal -->
    <p><strong>{{ __('patients.fields.personalAutonomy') }}:</strong> {{ $patient->personalAutonomy }}</p>

    <!-- Situación económica -->
    <p><strong>{{ __('patients.fields.economicSituation') }}:</strong> {{ $patient->economicSituation }}</p>

    <!-- Enlace para volver a la lista de pacientes -->
    <a href="{{ route('patients.index') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Tornar</a>
</div>
@endsection
