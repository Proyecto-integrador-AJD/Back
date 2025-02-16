@extends('layouts.app')

@section('title', __('equips.titulo.creacion'))

@section('content')
<form action="{{ route('equips.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nom" class="form-label">{{ __('equips.campos.nombre') }}:</label>
        <input type="text" name="nom" id="nom" required
            class="form-control">
    </div>

    <div class="mb-3">
        <label for="titols" class="form-label">{{ __('equips.campos.titulos') }}:</label>
        <input type="number" name="titols" id="titols" required
            class="form-control">
    </div>

    <div class="mb-3">
        <label for="estadi_id" class="form-label">{{ __('equips.campos.estadio') }}:</label>
        <select name="estadi_id" id="estadi_id" required class="form-select">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}">{{ $estadi->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="escut" class="form-label">{{ __('equips.campos.escudo') }}:</label>
        <input type="file" name="escut" id="escut" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection
