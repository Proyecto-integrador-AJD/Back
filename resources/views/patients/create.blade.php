@extends('layouts.app')

@section('title', __('patients.titulo.creacion'))

@section('content')
<form action="{{ route('patients.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('patients.fields.name') }}:</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="lastName" class="form-label">{{ __('patients.fields.lastName') }}:</label>
        <input type="text" name="lastName" id="lastName" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="birthDate" class="form-label">{{ __('patients.fields.birthDate') }}:</label>
        <input type="date" name="birthDate" id="birthDate" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('patients.fields.email') }}:</label>
        <input type="text" name="email" id="email" required class="form-control">
    </div>


    <!-- Agrupación de campos de dirección -->
    <fieldset class="border p-3 mb-4 rounded">
        <legend class="text-primary">{{ __('patients.fields.address') }}</legend>

        <div class="mb-3">
            <label for="addressStreet" class="form-label">{{ __('patients.fields.addressStreet') }}:</label>
            <input type="text" name="addressStreet" id="addressStreet" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressNumber" class="form-label">{{ __('patients.fields.addressNumber') }}:</label>
            <input type="number" name="addressNumber" id="addressNumber" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressFloor" class="form-label">{{ __('patients.fields.addressFloor') }}:</label>
            <input type="text" name="addressFloor" id="addressFloor" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressDoor" class="form-label">{{ __('patients.fields.addressDoor') }}:</label>
            <input type="text" name="addressDoor" id="addressDoor" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressPostalCode" class="form-label">{{ __('patients.fields.addressPostalCode') }}:</label>
            <input type="text" name="addressPostalCode" id="addressPostalCode" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressCity" class="form-label">{{ __('patients.fields.addressCity') }}:</label>
            <input type="text" name="addressCity" id="addressCity" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressProvince" class="form-label">{{ __('patients.fields.addressProvince') }}:</label>
            <input type="text" name="addressProvince" id="addressProvince" class="form-control">
        </div>

        <div class="mb-3">
            <label for="addressCountry" class="form-label">{{ __('patients.fields.addressCountry') }}:</label>
            <input type="text" name="addressCountry" id="addressCountry" class="form-control">
        </div>
    </fieldset>

    <div class="mb-3">
        <label for="dni" class="form-label">{{ __('patients.fields.dni') }}:</label>
        <input type="text" name="dni" id="dni" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="healthCardNumber" class="form-label">{{ __('patients.fields.healthCardNumber') }}:</label>
        <input type="text" name="healthCardNumber" id="healthCardNumber" class="form-control">
    </div>

    <div class="mb-3">
        <label for="prefix" class="form-label">{{ __('patients.fields.prefix') }}:</label>
        <select id="prefix" name="prefix" required class="form-control">
            <option value="" disabled {{ old('prefix') ? '' : 'selected' }}>Selecciona un prefijo</option>
            @foreach ($prefixes as $prefix)
                <option value="{{ $prefix->prefix }}" {{ old('prefix') == $prefix->id ? 'selected' : '' }}>
                    {{ $prefix->prefix }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('patients.fields.phone') }}:</label>
        <input type="number" name="phone" id="phone" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="language" class="form-label">{{ __('patients.fields.language') }}:</label>
        <select name="language[]" id="language" multiple required class="form-control">
            @foreach ($languages as $key => $language)
                <option value="{{ $key }}" 
                    @if(in_array($key, old('language', json_decode($user->language ?? '[]', true)))) selected @endif>
                    {{ $language }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="zoneId" class="form-label">{{ __('patients.fields.zoneId') }}:</label>
        <select id="zoneId" name="zoneId" class="form-control">
            @foreach ($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="situationPersonalFamily" class="form-label">{{ __('patients.fields.situationPersonalFamily') }}:</label>
        <input type="text" name="situationPersonalFamily" id="situationPersonalFamily" class="form-control">
    </div>

    <div class="mb-3">
        <label for="healthSituation" class="form-label">{{ __('patients.fields.healthSituation') }}:</label>
        <input type="text" name="healthSituation" id="healthSituation" class="form-control">
    </div>

    <!-- Agrupación de campos de vivienda -->
    <fieldset class="border p-3 mb-4 rounded">
        <legend class="text-primary">{{ __('patients.fields.housing') }}</legend>

        <div class="mb-3">
            <label for="housingSituationType" class="form-label">{{ __('patients.fields.housingSituationType') }}:</label>
            <input type="text" name="housingSituationType" id="housingSituationType" class="form-control">
        </div>

        <div class="mb-3">
            <label for="housingSituationStatus" class="form-label">{{ __('patients.fields.housingSituationStatus') }}:</label>
            <input type="text" name="housingSituationStatus" id="housingSituationStatus" class="form-control">
        </div>

        <div class="mb-3">
            <label for="housingSituationNumberOfRooms" class="form-label">{{ __('patients.fields.housingSituationNumberOfRooms') }}:</label>
            <input type="number" name="housingSituationNumberOfRooms" id="housingSituationNumberOfRooms" class="form-control">
        </div>

        <div class="mb-3">
            <label for="housingSituationLocation" class="form-label">{{ __('patients.fields.housingSituationLocation') }}:</label>
            <input type="text" name="housingSituationLocation" id="housingSituationLocation" class="form-control">
        </div>
    </fieldset>

    <div class="mb-3">
        <label for="personalAutonomy" class="form-label">{{ __('patients.fields.personalAutonomy') }}:</label>
        <input type="text" name="personalAutonomy" id="personalAutonomy" class="form-control">
    </div>

    <div class="mb-3">
        <label for="economicSituation" class="form-label">{{ __('patients.fields.economicSituation') }}:</label>
        <input type="text" name="economicSituation" id="economicSituation" class="form-control">
    </div>








    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection