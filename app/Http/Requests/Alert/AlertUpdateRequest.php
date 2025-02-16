<?php

namespace App\Http\Requests\Alert;

use Illuminate\Foundation\Http\FormRequest;

class AlertUpdateRequest extends FormRequest
{
    /**
     * Determina si l'usuari està autoritzat a fer aquesta petició.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['admintrator', 'operator']);
    }

    /**
     * Obté les regles de validació aplicables a la petició.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patientId' => 'exists:patients,id',
            'type' => 'string|max:255',
            'subType' => 'string|max:255',
            'startDate' => 'date_format:Y-m-d H:i:s',
            'isRecurring' => 'boolean',
            'description' => 'nullable|string|max:255',
            'recurrenceType' => 'nullable|string|exists:recurrenceTypes,name|max:255',
            'recurrence' => 'nullable|integer', // no se para que es
        ];
    }

    public function messages(){
        return [
            'patientId.exists' => 'El paciente seleccionado no existe.',
            'type.string' => 'El campo "Tipo" debe ser una cadena de caracteres.',
            'type.max' => 'El campo "Tipo" no puede superar los 255 caracteres.',
            'subType.string' => 'El campo "Subtipo" debe ser una cadena de caracteres.',
            'subType.max' => 'El campo "Subtipo" no puede superar los 255 caracteres.',
            'startDate.date_format' => 'El campo "Fecha de inicio" debe tener el formato Y-m-d H:i:s.',
            'isRecurring.boolean' => 'El campo "Es recurrente" debe ser un booleano.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',
            'recurrenceType.string' => 'El campo "Tipo de recurrencia" debe ser una cadena de caracteres.',
            'recurrenceType.exists' => 'El tipo de recurrencia seleccionado no es válido.',
            'recurrenceType.max' => 'El campo "Tipo de recurrencia" no puede superar los 255 caracteres.',
            'recurrence.integer' => 'El campo "Recurrencia" debe ser un número entero.',
        ];
    }
}
