@extends('layouts.app')

@section('title', __('contacts.titulo.editar'))

@section('content')
<form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Campo para el nombre -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.name') }}:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $contact->name) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo para apellido -->
    <div class="mb-4">
        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.lastName') }}:</label>
        <input type="text" name="lastName" id="lastName" value="{{ old('lastName', $contact->lastName) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('lastName') border-red-500 @enderror">
        @error('lastName')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo para correo electrónico -->
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.email') }}:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
    <label for="prefix">Prefijo:</label>
        <select id="prefix" name="prefix" required>
            <option value="" disabled {{ old('prefix', $contact->prefix) ? '' : 'selected' }}>Selecciona un prefijo</option>
            @foreach ($prefixes as $prefix)
                <option value="{{ $prefix->prefix }}" {{ old('prefix', $contact->prefix) == $prefix->prefix ? 'selected' : '' }}>
                    {{ $prefix->prefix }}
                </option>
            @endforeach
        </select>
    </div>


    <!-- Campo para el teléfono -->
    <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.phone') }}:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('phone') border-red-500 @enderror">
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo para el ID del paciente -->
    <div class="mb-4">
        <label for="patientId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.patientId') }}:</label>
        <select name="patientId" id="patientId" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('patientId') border-red-500 @enderror">
            <option value="">{{ __('Seleccione un paciente') }}</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ old('patientId', $contact->patientId) == $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>
        @error('patientId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo para la relación -->
    <div class="mb-4">
        <label for="relationship" class="block text-sm font-medium text-gray-700 mb-1">{{ __('contacts.fields.relationship') }}:</label>
        <select name="relationship" id="relationship" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('relationship') border-red-500 @enderror">
    
            @foreach ($relationships as $relationship)
                <option value="{{ $relationship->name }}" {{ old('relationship', $contact->relationship) == $relationship->spanishName ? 'selected' : '' }}>
                    {{ $relationship->spanishName }}
                </option>
            @endforeach
        </select>
        @error('relationship')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>



    <!-- Botón de envío -->
    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        {{ __('btn.actualitzar') }} {{ __('contacts.titulo.editar') }}
    </button>
</form>
@endsection
