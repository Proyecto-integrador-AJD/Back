@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('contacts.title') }}</h1>

</a>
@if (session('success'))
    <div class="bg-green-500 text-black p-4 mb-6 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<table class="w-full border-collapse border border-gray-300">
<thead class="bg-gray-200">
    <tr>
        <th class="border border-gray-300 p-2">{{ __('contacts.fields.name') }}</th>
        <th class="border border-gray-300 p-2">{{ __('contacts.fields.patientsId') }}</th>
        <th class="border border-gray-300 p-2">{{ __('contacts.fields.phone') }}</th>
        <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($contacts as $contact)
        <tr class="hover:bg-gray-100">
            <!-- Datos -->
            <td class="border border-gray-300 p-2">
                <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-700 hover:underline">{{ $contact->name }} {{ $contact->lastName }}</a>
            </td>
            <td class="border border-gray-300 p-2">{{ $contact->Patient ? $contact->Patient->name : 'No asociado' }}</td>
            <td class="border border-gray-300 p-2">{{ $contact->prefix }} {{ $contact->phone }}</td>
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('contacts.show', $contact->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline">
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