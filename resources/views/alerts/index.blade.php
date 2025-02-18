@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('alerts.title') }}</h1>
<a href="{{ route('alerts.create') }}" class="bg-blue-500 text-blue font-medium">
    <!-- Crear -->
    <button>{{ __('btn.new') }}</button>
</a>
@if (session('success'))
    <div class="bg-green-500 text-black p-4 mb-6 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
        <!-- Campos -->
            <th class="border border-gray-300 p-2">{{ __('alerts.fields.patientId') }}</th>
            <th class="border border-gray-300 p-2">{{ __('alerts.fields.type') }}</th>
            <th class="border border-gray-300 p-2">{{ __('alerts.fields.startDate') }}</th>
            <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alerts as $alert)
            <tr class="hover:bg-gray-100">
                <!-- Datos -->
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('alerts.show', $alert->id) }}" class="text-blue-700 hover:underline">{{ $alert->Patient ? $alert->Patient->name : 'No asociado' }}</a>
                </td>

                <td class="border border-gray-300 p-2">{{ $alert->type }} </td>
                <td class="border border-gray-300 p-2">{{ $alert->startDate }}</td>
              

                <td class="border border-gray-300 p-2 flex space-x-2">
                    <a href="{{ route('alerts.show', $alert->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                    <a href="{{ route('alerts.edit', $alert->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                    <form action="{{ route('alerts.destroy', $alert->id) }}" method="POST" class="inline">
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