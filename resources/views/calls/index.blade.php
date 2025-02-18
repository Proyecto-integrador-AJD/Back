@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('calls.title') }}</h1>
<a href="{{ route('calls.create') }}" class="bg-blue-500 text-blue font-medium">
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
        <th class="border border-gray-300 p-2">{{ __('calls.fields.patientId') }}</th>
        <th class="border border-gray-300 p-2">{{ __('calls.fields.userId') }}</th>
        <th class="border border-gray-300 p-2">{{ __('calls.fields.date') }}</th>
        <th class="border border-gray-300 p-2">{{ __('calls.fields.incoming') }}</th>
        <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($calls as $call)
        <tr class="hover:bg-gray-100">
            <!-- Datos -->
            <td class="border border-gray-300 p-2">
                <a href="{{ route('calls.show', $call->id) }}" class="text-blue-700 hover:underline">{{ $call->Patient->name }} {{ $call->Patient->lastName }}</a>
            </td>
            <td class="border border-gray-300 p-2">{{ $call->User->name }} {{ $call->User->lastName }}</td>
            <td class="border border-gray-300 p-2">{{ $call->date }} </td>
            <td class="border border-gray-300 p-2">
                {{ $call->incoming == 1 ? 'Entrante' : 'Saliente' }}
            </td>
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('calls.show', $call->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                <a href="{{ route('calls.edit', $call->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                <form action="{{ route('calls.destroy', $call->id) }}" method="POST" class="inline">
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