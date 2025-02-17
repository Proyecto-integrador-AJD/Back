@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('zones.title') }}</h1>
<a href="{{ route('zones.create') }}" class="bg-blue-500 text-blue font-medium">
    <!-- Crear -->
    <button>{{ __('btn.new') }}</button>
</a>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
        <!-- Campos -->
            <th class="border border-gray-300 p-2">{{ __('zones.fields.name') }}</th>
            <th class="border border-gray-300 p-2">{{ __('zones.fields.description') }}</th>
            <th class="border border-gray-300 p-2">{{ __('zones.fields.location') }}</th>
            <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($zones as $zone)
            <tr class="hover:bg-gray-100">
                <!-- Datos -->
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('zones.show', $zone->id) }}" class="text-blue-700 hover:underline">{{ $zone->name }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $zone->description }}</td>
                <td class="border border-gray-300 p-2">{{ $zone->location }}</td>
                <td class="border border-gray-300 p-2 flex space-x-2">
                    <a href="{{ route('zones.show', $zone->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                    <a href="{{ route('zones.edit', $zone->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                    <form action="{{ route('zones.destroy', $zone->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">{{ __('btn.borrar') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
