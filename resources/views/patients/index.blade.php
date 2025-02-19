@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('patients.title') }}</h1>
<a href="{{ route('patients.create') }}" class="bg-blue-500 text-blue font-medium">
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
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.name') }} </th>
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.email') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.phone') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.userId') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.zoneId') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('patients.fields.language') }}</th>
            <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            <tr class="hover:bg-gray-100">
                <!-- Datos -->
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('patients.show', $patient->id) }}" class="text-blue-700 hover:underline">{{ $patient->name }} {{ $patient->lastName }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $patient->email }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->prefix }} {{ $patient->phone }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->User ? $patient->User->name : 'No asociado' }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->Zone ? $patient->Zone->name : 'Zona no asignada' }}</td>

                <td class="border border-gray-300 p-2">{{ implode(', ', $patient->language )}}</td>
                <td class="border border-gray-300 p-2 flex space-x-2">
                    <a href="{{ route('patients.show', $patient->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
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