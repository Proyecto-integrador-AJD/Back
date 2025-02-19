@extends('layouts.app')

@section('title', __('patients.titulo.editar'))

@section('content')
<form action="{{ route('patients.update', $patient->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.name') }}:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Apellido -->
    <div class="mb-4">
        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.lastName') }}:</label>
        <input type="text" name="lastName" id="lastName" value="{{ old('lastName', $patient->lastName) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('lastName') border-red-500 @enderror">
        @error('lastName')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Fecha de nacimiento -->
    <div class="mb-4">
        <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.birthDate') }}:</label>
        <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate', $patient->birthDate) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('birthDate') border-red-500 @enderror">
        @error('birthDate')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Dirección -->
    <fieldset class="border p-3 mb-4 rounded">
        <legend class="text-primary">{{ __('patients.fields.address') }}</legend>

        <!-- Calle -->
        <div class="mb-4">
            <label for="addressStreet" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressStreet') }}:</label>
            <input type="text" name="addressStreet" id="addressStreet" value="{{ old('addressStreet', $patient->addressStreet) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressStreet') border-red-500 @enderror">
            @error('addressStreet')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Número -->
        <div class="mb-4">
            <label for="addressNumber" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressNumber') }}:</label>
            <input type="number" name="addressNumber" id="addressNumber" value="{{ old('addressNumber', $patient->addressNumber) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressNumber') border-red-500 @enderror">
            @error('addressNumber')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Piso -->
        <div class="mb-4">
            <label for="addressFloor" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressFloor') }}:</label>
            <input type="text" name="addressFloor" id="addressFloor" value="{{ old('addressFloor', $patient->addressFloor) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressFloor') border-red-500 @enderror">
            @error('addressFloor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Puerta -->
        <div class="mb-4">
            <label for="addressDoor" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressDoor') }}:</label>
            <input type="text" name="addressDoor" id="addressDoor" value="{{ old('addressDoor', $patient->addressDoor) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressDoor') border-red-500 @enderror">
            @error('addressDoor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Código Postal -->
        <div class="mb-4">
            <label for="addressPostalCode" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressPostalCode') }}:</label>
            <input type="text" name="addressPostalCode" id="addressPostalCode" value="{{ old('addressPostalCode', $patient->addressPostalCode) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressPostalCode') border-red-500 @enderror">
            @error('addressPostalCode')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ciudad -->
        <div class="mb-4">
            <label for="addressCity" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressCity') }}:</label>
            <input type="text" name="addressCity" id="addressCity" value="{{ old('addressCity', $patient->addressCity) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressCity') border-red-500 @enderror">
            @error('addressCity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Provincia -->
        <div class="mb-4">
            <label for="addressProvince" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressProvince') }}:</label>
            <input type="text" name="addressProvince" id="addressProvince" value="{{ old('addressProvince', $patient->addressProvince) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressProvince') border-red-500 @enderror">
            @error('addressProvince')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- País -->
        <div class="mb-4">
            <label for="addressCountry" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.addressCountry') }}:</label>
            <input type="text" name="addressCountry" id="addressCountry" value="{{ old('addressCountry', $patient->addressCountry) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('addressCountry') border-red-500 @enderror">
            @error('addressCountry')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </fieldset>

    <!-- DNI -->
    <div class="mb-4">
        <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.dni') }}:</label>
        <input type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('dni') border-red-500 @enderror">
        @error('dni')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Número de tarjeta de salud -->
    <div class="mb-4">
        <label for="healthCardNumber" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.healthCardNumber') }}:</label>
        <input type="text" name="healthCardNumber" id="healthCardNumber" value="{{ old('healthCardNumber', $patient->healthCardNumber) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('healthCardNumber') border-red-500 @enderror">
        @error('healthCardNumber')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Teléfono -->
    <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.phone') }}:</label>
        <input type="number" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror">
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.email') }}:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Idioma -->
    <div class="mb-4">
        <label for="language" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.language') }}:</label>
        <select name="language[]" id="language" multiple required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @foreach ($languages as $key => $language)
                <option value="{{ $key }}" 
                    @if(in_array($key, old('language', is_array($patient->language) ? $patient->language : json_decode($patient->language ?? '[]', true)))) selected @endif>
                    {{ $language }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Zona -->
    <div class="mb-4">
        <label for="zoneId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.zoneId') }}:</label>
        <select name="zoneId" id="zoneId" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('zoneId') border-red-500 @enderror">
            @foreach ($zones as $zone)
                <option value="{{ $zone->id }}" @if($zone->id == old('zoneId', $patient->zoneId)) selected @endif>
                    {{ $zone->name }}
                </option>
            @endforeach
        </select>
        @error('zoneId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Situación personal y familiar -->
    <div class="mb-4">
        <label for="situationPersonalFamily" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.situationPersonalFamily') }}:</label>
        <input type="text" name="situationPersonalFamily" id="situationPersonalFamily" value="{{ old('situationPersonalFamily', $patient->situationPersonalFamily) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('situationPersonalFamily') border-red-500 @enderror">
        @error('situationPersonalFamily')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Situación de salud -->
    <div class="mb-4">
        <label for="healthSituation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.healthSituation') }}:</label>
        <input type="text" name="healthSituation" id="healthSituation" value="{{ old('healthSituation', $patient->healthSituation) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('healthSituation') border-red-500 @enderror">
        @error('healthSituation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Situación de vivienda -->
    <div class="mb-4">
        <label for="housingSituationType" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.housingSituationType') }}:</label>
        <input type="text" name="housingSituationType" id="housingSituationType" value="{{ old('housingSituationType', $patient->housingSituationType) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('housingSituationType') border-red-500 @enderror">
        @error('housingSituationType')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Estado de vivienda -->
    <div class="mb-4">
        <label for="housingSituationStatus" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.housingSituationStatus') }}:</label>
        <input type="text" name="housingSituationStatus" id="housingSituationStatus" value="{{ old('housingSituationStatus', $patient->housingSituationStatus) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('housingSituationStatus') border-red-500 @enderror">
        @error('housingSituationStatus')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Número de habitaciones -->
    <div class="mb-4">
        <label for="housingSituationNumberOfRooms" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.housingSituationNumberOfRooms') }}:</label>
        <input type="number" name="housingSituationNumberOfRooms" id="housingSituationNumberOfRooms" value="{{ old('housingSituationNumberOfRooms', $patient->housingSituationNumberOfRooms) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('housingSituationNumberOfRooms') border-red-500 @enderror">
        @error('housingSituationNumberOfRooms')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ubicación de vivienda -->
    <div class="mb-4">
        <label for="housingSituationLocation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.housingSituationLocation') }}:</label>
        <input type="text" name="housingSituationLocation" id="housingSituationLocation" value="{{ old('housingSituationLocation', $patient->housingSituationLocation) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('housingSituationLocation') border-red-500 @enderror">
        @error('housingSituationLocation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Autonomía personal -->
    <div class="mb-4">
        <label for="personalAutonomy" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.personalAutonomy') }}:</label>
        <input type="text" name="personalAutonomy" id="personalAutonomy" value="{{ old('personalAutonomy', $patient->personalAutonomy) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('personalAutonomy') border-red-500 @enderror">
        @error('personalAutonomy')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Situación económica -->
    <div class="mb-4">
        <label for="economicSituation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('patients.fields.economicSituation') }}:</label>
        <input type="text" name="economicSituation" id="economicSituation" value="{{ old('economicSituation', $patient->economicSituation) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('economicSituation') border-red-500 @enderror">
        @error('economicSituation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        {{ __('btn.actualitzar') }} {{ __('users.title.edit') }}
    </button>
</form>
@endsection
