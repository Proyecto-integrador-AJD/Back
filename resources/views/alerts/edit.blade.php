@extends('layouts.app')

@section('title', __('alerts.title.edicion'))

@section('content')
<form action="{{ route('alerts.update', $alert->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Directiva para el método PUT (Laravel lo requiere para actualizar registros) --}}
    
    <div class="mb-4">
        <label for="patientId" class="block text-sm font-medium text-gray-700 mb-1">{{ __('alerts.fields.patientId') }}:</label>
        <select name="patientId" id="patientId" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500
            @error('patientId') border-red-500 @enderror">
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ old('patientId', $alert->patientId) == $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }} {{ $patient->lastName }}
                </option>
            @endforeach
        </select>
        @error('patientId')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">{{ __('alerts.fields.type') }}:</label>
        <select name="type" id="type" required class="form-control">
            <option value=""></option>
            {{-- Opciones de tipo se llenarán mediante JavaScript, como en el formulario de creación --}}
        </select>
        @error('type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="subType" class="form-label">{{ __('alerts.fields.subType') }}:</label>
        <select name="subType" id="subType" required class="form-control" disabled>
            <option value=""></option>
            {{-- Opciones de subtipo también se llenarán mediante JavaScript --}}
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
                const subTypeSelect = document.getElementById("subType");

                // Poblar el select de tipo
                data.forEach((alertType) => {
                    const option = document.createElement("option");
                    option.value = alertType.name;
                    option.textContent = alertType.spanishName || alertType.name;
                    typeSelect.appendChild(option);
                });

                // Preseleccionar el valor actual de la alerta
                typeSelect.value = "{{ $alert->type }}";

                // Manejar cambios de tipo
                typeSelect.addEventListener("change", function () {
                    const selectedTypeName = this.value;
                    subTypeSelect.innerHTML = '<option value=""></option>';
                    subTypeSelect.disabled = true;

                    const selectedType = data.find(type => type.name === selectedTypeName);
                    if (selectedType && selectedType.subtypes.length > 0) {
                        selectedType.subtypes.forEach(subtype => {
                            const option = document.createElement("option");
                            option.value = subtype.name;
                            option.textContent = subtype.spanishName || subtype.name;
                            subTypeSelect.appendChild(option);
                        });
                        subTypeSelect.disabled = false;

                        // Preseleccionar el subtipo actual
                        subTypeSelect.value = "{{ $alert->subType }}";
                    }
                });

                // Simular un cambio para cargar los subtipos y preseleccionar el valor
                typeSelect.dispatchEvent(new Event("change"));
            })
            .catch(error => console.error('Error loading alert types:', error));
    });
    </script>

    <div class="mb-3">
        <input type="checkbox" name="isRecurring" id="isRecurring" value="1" class="form-check-input" {{ $alert->isRecurring ? 'checked' : '' }}>
        <label class="form-check-label" for="isRecurring">{{ __('alerts.fields.isRecurring') }}</label>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('alerts.fields.description') }}:</label>
        <input type="text" name="description" id="description" required class="form-control" value="{{ $alert->description }}">
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">{{ __('alerts.fields.startDate') }}:</label>
        <input type="datetime-local" name="startDate" id="startDate" required class="form-control" value="{{ $alert->startDate }}">
    </div>

    <div class="mb-3">
        <label for="recurrenceType" class="form-label">{{ __('alerts.fields.recurrenceType') }}:</label>
        <select id="recurrenceType" name="recurrenceType" class="form-control">
            @foreach ($recurrenceTypes as $recurrenceType)
                <option value="{{ $recurrenceType->name }}" {{ $recurrenceType->name == $alert->recurrenceType ? 'selected' : '' }}>
                    {{ $recurrenceType->spanishName }}
                </option>
            @endforeach
        </select>
        @error('recurrenceType')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">{{ __('btn.actualitzar') }} {{ __('alerts.title.edit') }}</button>
</form>
@endsection
