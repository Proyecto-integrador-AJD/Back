@extends('layouts.app')
@section('content')
<!-- Titulo -->
<h1 class="text-3xl font-bold text-blue-800 mb-6">{{ __('users.title') }}</h1>
<a href="{{ route('users.create') }}" class="bg-blue-500 text-blue font-medium">
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
            <th class="border border-gray-300 p-2"> {{ __('users.fields.name') }} </th>
            <th class="border border-gray-300 p-2"> {{ __('users.fields.email') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('users.fields.phone') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('users.fields.username') }}</th>
            <th class="border border-gray-300 p-2"> {{ __('users.fields.language') }}</th>
            <th class="border border-gray-300 p-2">{{ __('fields.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="hover:bg-gray-100">
                <!-- Datos -->
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('users.show', $user->id) }}" class="text-blue-700 hover:underline">{{ $user->name }} {{ $user->lastName }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                <td class="border border-gray-300 p-2">{{ $user->prefix }} {{ $user->phone }}</td>
                <td class="border border-gray-300 p-2">{{ $user->username }}</td>
                <td class="border border-gray-300 p-2">{{ implode(', ', $user->language )}}</td>
                <td class="border border-gray-300 p-2 flex space-x-2">
                    <a href="{{ route('users.show', $user->id) }}" class="text-green-600 hover:underline">{{ __('btn.show') }}</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600 hover:underline">{{ __('btn.edit') }}</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
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