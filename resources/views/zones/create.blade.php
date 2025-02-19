@extends('layouts.app')

@section('title', __('zones.titulo.creacion'))

@section('content')
<form action="{{ route('zones.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('zones.fields.name') }}:</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('zones.fields.description') }}:</label>
        <input type="text" name="description" id="description" required class="form-control">
    </div>

    <div class="mb-3">
    <label for="location" class="form-label">{{ __('zones.fields.location') }}:</label>
        <input type="text" name="location" id="location" required
            class="form-control">
    </div>


    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection
