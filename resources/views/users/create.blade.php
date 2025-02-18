@extends('layouts.app')

@section('title', __('users.titulo.creacion'))

@section('content')
<form action="{{ route('users.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('users.fields.name') }}:</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="lastName" class="form-label">{{ __('users.fields.lastName') }}:</label>
        <input type="text" name="lastName" id="lastName" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('users.fields.email') }}:</label>
        <input type="text" name="email" id="email" required class="form-control">
    </div>

    <div class="mb-3">
    <label for="password" class="form-label">{{ __('users.fields.password') }}:</label>
        <input type="text" name="password" id="password" required
            class="form-control">
    </div>

    <div class="mb-4">
        <label for="prefix">{{ __('users.fields.prefix') }}:</label>
        <select id="prefix" name="prefix" required class="form-control">
            <option value="" disabled {{ old('prefix') ? '' : 'selected' }}>Selecciona un prefijo</option>
            @foreach ($prefixes as $prefix)
                <option value="{{ $prefix->prefix }}" {{ old('prefix') == $prefix->id ? 'selected' : '' }}>
                    {{ $prefix->prefix }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label for="phone" class="form-label">{{ __('users.fields.phone') }}:</label>
        <input type="number" name="phone" id="phone" required
            class="form-control">
    </div>

    <div class="mb-3">
    <label for="dateHire" class="form-label">{{ __('users.fields.dateHire') }}:</label>
        <input type="date" name="dateHire" id="dateHire" required
            class="form-control">
    </div>

    <div class="mb-3">
    <label for="username" class="form-label">{{ __('users.fields.username') }}:</label>
        <input type="text" name="username" id="username" required
            class="form-control">
    </div>
    <div class="mb-3">
    <label for="language" class="form-label">{{ __('users.fields.language') }}:</label>
        <select name="language[]" id="language" multiple required class="form-control">
            @foreach ($languages as $key => $language)
                <option value="{{ $key }}" 
                    @if(in_array($key, old('language', json_decode($user->language ?? '[]', true)))) selected @endif>
                    {{ $language }}
                </option>
            @endforeach
        </select>
    </div>





    

    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection