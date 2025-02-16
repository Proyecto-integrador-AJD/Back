<?php

namespace App\Http\Requests\Alert;

use Illuminate\Foundation\Http\FormRequest;

class AlertStoreRequest extends FormRequest
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
            'patientId' => 'required|exists:patients,id',
            'type' => 'required|string|max:255',
            'subType' => 'required|string|max:255',
            'startDate' => 'required|date_format:Y-m-d H:i:s',
            'isRecurring' => 'required|boolean',
            'description' => 'nullable|string|max:255',
            'recurrenceType' => 'nullable|string|exists:recurrenceTypes,name|max:255',
            'recurrence' => 'nullable|integer', // no se para que es
        ];


                // 'type' => [
                //     'required',
                //     'exists:alertTypes,name',
                // ],
                // 'subtype' => [
                //     'required',
                //     'exists:alertSubtypes,name',
                //     function ($attribute, $value, $fail) {
                //         $type = $this->input('type');
                //         $name = $this->input('name');
                //         if (!AlertSubtype::where('name', $name)->where('alertType', $type)->exists()) {
                //             $fail('El subtipo seleccionado no pertenece al tipo proporcionado.');
                //         }
                //     },
                // ],
    }

    public function messages(){
        return [
            'patientId.required' => 'El campo "Paciente" es obligatorio.',
            'patientId.exists' => 'El paciente seleccionado no existe.',
            'type.required' => 'El campo "Tipo" es obligatorio.',
            'type.string' => 'El campo "Tipo" debe ser una cadena de caracteres.',
            'type.max' => 'El campo "Tipo" no puede superar los 255 caracteres.',
            'subType.required' => 'El campo "Subtipo" es obligatorio.',
            'subType.string' => 'El campo "Subtipo" debe ser una cadena de caracteres.',
            'subType.max' => 'El campo "Subtipo" no puede superar los 255 caracteres.',
            'startDate.required' => 'El campo "Fecha de inicio" es obligatorio.',
            'startDate.date_format' => 'El campo "Fecha de inicio" debe tener el formato Y-m-d H:i:s.',
            'isRecurring.required' => 'El campo "Es recurrente" es obligatorio.',
            'isRecurring.boolean' => 'El campo "Es recurrente" debe ser un booleano.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',
            'recurrenceType.string' => 'El campo "Tipo de recurrencia" debe ser una cadena de caracteres.',
            'recurrenceType.exists' => 'El tipo de recurrencia seleccionado no es válido.',
            'recurrenceType.max' => 'El campo "Tipo de recurrencia" no puede superar los 255 caracteres.',
            'recurrence.integer' => 'El campo "Recurrencia" debe ser un número entero.',
        ];
    }
}
