@extends('layouts.app')

@section('title', __('calls.titulo.creacion'))

@section('content')
<form action="{{ route('calls.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label for="patientId" class="form-label">{{ __('calls.fields.patientId') }}:</label>
        <select id="patientId" name="patientId" class="form-control">
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="userId" class="form-label">{{ __('calls.fields.userId') }}:</label>
        <select id="userId" name="userId" class="form-control">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">{{ __('calls.fields.date') }}:</label>
        <input type="date" name="locadatetion" id="locatdateion" required class="form-control">
    </div>

 
        <!-- <div class="mb-3">
        <label for="incoming" class="form-label">{{ __('calls.fields.incoming') }}:</label>
        <select name="incoming" id="incoming" required class="form-control">
            <option value="1">{{ __('calls.fields.incoming_option_1') }}</option>
            <option value="0">{{ __('calls.fields.incoming_option_0') }}</option>
        </select>
    </div> -->
    <div class="mb-3">
    <label for="incoming" class="form-label">{{ __('calls.fields.incoming') }}:</label>
    <div>
        <input type="checkbox" name="incoming" id="incoming" value="1" class="form-check-input">
        <label class="form-check-label" for="incoming">{{ __('calls.fields.incoming_option_1') }}</label>
    </div>
   
</div>

    <div class="mb-3">
        <label for="date" class="form-label">{{ __('calls.fields.date') }}:</label>
        <input type="date" name="date" id="date" required class="form-control" placeholder="YYYY-MM-DD HH:MM:SS">
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">{{ __('calls.fields.type') }}:</label>
        <input type="text" name="pattypeientId" id="patientypetId" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="subType" class="form-label">{{ __('calls.fields.subType') }}:</label>
        <input type="text" name="subType" id="ussubTypeerId" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="alertId" class="form-label">{{ __('calls.fields.alertId') }}:</label>
        <select id="alertId" name="alertId" class="form-control">
            @foreach ($alerts as $alert)
                <option value="{{ $alert->id }}">{{ $alert->id }}</option>
            @endforeach
        </select>
    </div>

  
    <div class="mb-3">
        <label for="duration" class="form-label">{{ __('calls.fields.duration') }}:</label>
        <input type="number" name="duration" id="duration" class="form-control">
    </div>

    <!-- Alert ID (opcional) -->
    <div class="mb-3">
        <label for="description" class="form-label">{{ __('calls.fields.description') }}:</label>
        <input type="text" name="description" id="description" class="form-control">
    </div>

    <!-- Duración -->
    <div class="mb-3">
        <label for="duration" class="form-label">{{ __('calls.fields.duration') }}:</label>
        <input type="number" name="duration" id="duration" required class="form-control">
    </div>

    <!-- Descripción -->
    <div class="mb-3">
        <label for="description" class="form-label">{{ __('calls.fields.description') }}:</label>
        <textarea name="description" id="description" required class="form-control"></textarea>
    </div>

    <!-- Botón de submit -->
    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection
