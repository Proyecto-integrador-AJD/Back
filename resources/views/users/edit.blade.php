@extends('layouts.app')

@section('title', __('users.titulo.editar'))

@section('content')
<form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.name') }}:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.lastName') }}:</label>
        <input type="text" name="lastName" id="lastName" value="{{ old('lastName', $user->lastName) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('lastName') border-red-500 @enderror">
        @error('lastName')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.email') }}:</label>
        <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.password') }}:</label>
        <input type="text" name="password" id="password" value="{{ old('password', $user->password) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('password') border-red-500 @enderror">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

  
   
    <div class="mb-4">
    <label for="prefix">Prefijo:</label>
        <select id="prefix" name="prefix" required>
            <option value="" disabled {{ old('prefix', $user->prefix) ? '' : 'selected' }}>Selecciona un prefijo</option>
            @foreach ($prefixes as $prefix)
                <option value="{{ $prefix->prefix }}" {{ old('prefix', $user->prefix) == $prefix->prefix ? 'selected' : '' }}>
                    {{ $prefix->prefix }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.phone') }}:</label>
        <input type="number" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('phone') border-red-500 @enderror">
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="dateHire" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.dateHire') }}:</label>
        <input type="date" name="dateHire" id="dateHire" value="{{ old('dateHire', $user->dateHire) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('dateHire') border-red-500 @enderror">
        @error('dateHire')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">{{ __('users.fields.username') }}:</label>
        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('username') border-red-500 @enderror">
        @error('username')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        {{ __('btn.actualitzar') }} {{ __('users.title.edit') }}
    </button>
</form>
@endsection