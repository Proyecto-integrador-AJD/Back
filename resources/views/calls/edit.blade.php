@extends('layouts.app')

@section('title', __('calls.titulo.editar'))

@section('content')
<form action="{{ route('calls.update', $call->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Campo Date -->
    <div class="mb-4">
        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.date') }}:</label>
        <input type="text" name="date" id="date" value="{{ old('date', $call->date) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('date') border-red-500 @enderror">
        @error('date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo patientId (Con Select) -->
    <div class="mb-4">
        <label for="patientId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.patientId') }}:</label>
        <select name="patientId" id="patientId" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500
            @error('patientId') border-red-500 @enderror">
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ old('patientId', $call->patientId) == $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }} {{ $patient->lastName }}
                </option>
            @endforeach
        </select>
        @error('patientId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo userId (Con Select) -->
    <div class="mb-4">
        <label for="userId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.userId') }}:</label>
        <select name="userId" id="userId" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500
            @error('userId') border-red-500 @enderror">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('userId', $call->userId) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} {{ $user->lastName }}
                </option>
            @endforeach
        </select>
        @error('userId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo Incoming (booleano) -->
    <div class="mb-4">
        <label for="incoming" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.incoming') }}:</label>
        <input type="checkbox" name="incoming" id="incoming" value="1" {{ old('incoming', $call->incoming) ? 'checked' : '' }} 
            class="form-check-input">
        <label for="incoming">{{ __('calls.fields.incoming_option_1') }}</label>
        @error('incoming')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo Type -->
    <div class="mb-4">
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.type') }}:</label>
        <input type="text" name="type" id="type" value="{{ old('type', $call->type) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('type') border-red-500 @enderror">
        @error('type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo SubType -->
    <div class="mb-4">
        <label for="subType" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.subType') }}:</label>
        <input type="text" name="subType" id="subType" value="{{ old('subType', $call->subType) }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('subType') border-red-500 @enderror">
        @error('subType')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo AlertId -->
    <div class="mb-4">
        <label for="alertId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.alertId') }}:</label>
        <input type="text" name="alertId" id="alertId" value="{{ old('alertId', $call->alertId) }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('alertId') border-red-500 @enderror">
        @error('alertId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo Duration -->
    <div class="mb-4">
        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.duration') }}:</label>
        <input type="number" name="duration" id="duration" value="{{ old('duration', $call->duration) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('duration') border-red-500 @enderror">
        @error('duration')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Campo Description -->
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('calls.fields.description') }}:</label>
        <input type="text" name="description" id="description" value="{{ old('description', $call->description) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('description') border-red-500 @enderror">
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Botón de Submit -->
    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        {{ __('btn.actualitzar') }} {{ __('calls.title.edit') }}
    </button>
</form>
@endsection
