@extends('layouts.app')

@section('title', __('zones.titulo.editar'))

@section('content')
<form action="{{ route('zones.update', $zone->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('zones.fields.name') }}:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $zone->name) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('zones.fields.description') }}:</label>
        <input type="text" name="description" id="description" value="{{ old('description', $zone->description) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('description') border-red-500 @enderror">
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">{{ __('zones.fields.location') }}:</label>
        <input type="text" name="location" id="location" value="{{ old('location', $zone->location) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('location') border-red-500 @enderror">
        @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        {{ __('btn.actualitzar') }} {{ __('zones.titulo.editar') }}
    </button>
</form>
@endsection
