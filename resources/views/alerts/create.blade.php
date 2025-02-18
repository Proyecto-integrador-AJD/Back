@extends('layouts.app')

@section('title', __('alerts.title.creacion'))

@section('content')
<form action="{{ route('alerts.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label for="patientId" class="form-label">{{ __('alerts.fields.patientId') }}:</label>
        <select id="patientId" name="patientId" class="form-control">
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
        </select>
        @error('patients')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <div class="mb-3">
    <label for="type" class="form-label">{{ __('alerts.fields.type') }}:</label>
    <select name="type" id="type" required class="form-control">
        <option value=""></option>
    </select>
    @error('type')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="subType" class="form-label">{{ __('alerts.fields.subType') }}:</label>
    <select name="subType" id="subType" required class="form-control" disabled>
        <option value=""></option>
    </select>
    @error('subType')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


    <script>
    document.addEventListener("DOMContentLoaded", function () {
    fetch('/alert-types')
        .then(response => response.json())
        .then(data => {
            const typeSelect = document.getElementById("type");

            // Poblar el select de tipo
            data.forEach((alertType) => {
                const option = document.createElement("option");
                option.value = alertType.name; // Usa 'name' si 'id' es null
                option.textContent = alertType.spanishName || alertType.name;
                typeSelect.appendChild(option);
            });

            typeSelect.addEventListener("change", function () {
                const selectedTypeName = this.value;
                const subTypeSelect = document.getElementById("subType");
                subTypeSelect.innerHTML = '<option value="">{{ __('') }}</option>';
                subTypeSelect.disabled = true;

                // Encontrar el tipo seleccionado y poblar subtipos
                const selectedType = data.find(type => type.name === selectedTypeName);
                if (selectedType && selectedType.subtypes.length > 0) {
                    selectedType.subtypes.forEach(subtype => {
                        const option = document.createElement("option");
                        option.value = subtype.name;
                        option.textContent = subtype.spanishName || subtype.name;
                        subTypeSelect.appendChild(option);
                    });
                    subTypeSelect.disabled = false;
                }
            });
        })
        .catch(error => console.error('Error loading alert types:', error));
});


</script>

    <div class="mb-3">
    <label for="isRecurring" class="form-label"></label>
    <div>
        <input type="checkbox" name="isRecurring" id="isRecurring" value="1" class="form-check-input">
        <label class="form-check-label" for="isRecurring">{{ __('alerts.fields.isRecurring') }}</label>
    </div>
    @error('isRecurring')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('alerts.fields.description') }}:</label>
        <input type="text" name="description" id="description" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">{{ __('alerts.fields.startDate') }}:</label>
        <input type="datetime-local" name="startDate" id="startDate" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="recurrenceType" class="form-label">{{ __('alerts.fields.recurrenceType') }}:</label>
        <select id="recurrenceType" name="recurrenceType" class="form-control">
            @foreach ($recurrenceTypes as $recurrenceType)
                <option value="{{ $recurrenceType->name }}">{{ $recurrenceType->spanishName }}</option>
            @endforeach
        </select>
        @error('recurrenceType')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    



  

    <!-- Botón de submit -->
    <button type="submit" class="btn btn-primary w-100">{{ __('btn.crear') }}</button>
</form>
@endsection