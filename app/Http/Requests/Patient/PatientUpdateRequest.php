<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
{
    /**
     * Determina si l'usuari està autoritzat a fer aquesta petició.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user(); // Obtener el usuario autenticado

        if (!$user) {
            return false; // Si no hay usuario autenticado, denegar la petición
        }
        return $user->hasAnyRole(['admintrator', 'operator']);
    }

    /**
     * Obté les regles de validació aplicables a la petició.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentHealthCardNumber = $this->route('patient')->healthCardNumber;
        $currentEmail = $this->route('patient')->email;
        return [
            'name' => 'string|max:255',
            'lastName' => 'string|max:255',
            'birthDate' => 'date',
            'addressStreet' => 'string|max:255',
            'addressNumber' => 'integer',
            'addressFloor' => 'nullable|string|max:255',
            'addressDoor' => 'nullable|string|max:255',
            'addressPostalCode' => 'integer',
            'addressCity' => 'string|max:255',
            'addressProvince' => 'string|max:255',
            'addressCountry' => 'string|max:255',
            'healthCardNumber' => 'string|unique:patients,healthCardNumber,' . $currentHealthCardNumber . ',healthCardNumber|max:255',
            'prefix' => 'exists:prefixes,prefix',
            'phone' => 'integer',
            'email' => 'email|unique:patients,email,'. $currentEmail .',email|max:255',
            'language' => 'array',
            'language.*' => 'string|max:255',
            'zoneId' => 'exists:zones,id',
            'situationPersonalFamily' => 'string|max:255',
            'healthSituation' => 'string|max:255',
            'housingSituationType' => 'string|max:255',
            'housingSituationStatus' => 'string|max:255',
            'housingSituationNumberOfRooms' => 'integer',
            'housingSituationLocation' => 'string|max:255',
            'personalAutonomy' => 'string|max:255',
            'economicSituation' => 'string|max:255',
        ];
    }

    /**
     * Obté els missatges d'error personalitzats per a cada regla.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'lastName.string' => 'El campo apellido debe ser una cadena de texto.',
            'lastName.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            'birthDate.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'addressStreet.string' => 'El campo calle debe ser una cadena de texto.',
            'addressStreet.max' => 'El campo calle no puede tener más de 255 caracteres.',
            'addressNumber.integer' => 'El campo número de dirección debe ser un número entero.',
            'addressFloor.string' => 'El campo piso debe ser una cadena de texto.',
            'addressFloor.max' => 'El campo piso no puede tener más de 255 caracteres.',
            'addressDoor.string' => 'El campo puerta debe ser una cadena de texto.',
            'addressDoor.max' => 'El campo puerta no puede tener más de 255 caracteres.',
            'addressPostalCode.integer' => 'El campo código postal debe ser un número entero.',
            'addressCity.string' => 'El campo ciudad debe ser una cadena de texto.',
            'addressCity.max' => 'El campo ciudad no puede tener más de 255 caracteres.',
            'addressProvince.string' => 'El campo provincia debe ser una cadena de texto.',
            'addressProvince.max' => 'El campo provincia no puede tener más de 255 caracteres.',
            'addressCountry.string' => 'El campo país debe ser una cadena de texto.',
            'addressCountry.max' => 'El campo país no puede tener más de 255 caracteres.',
            'healthCardNumber.string' => 'El campo número de tarjeta sanitaria debe ser una cadena de texto.',
            'healthCardNumber.unique' => 'El número de tarjeta sanitaria ya está en uso.',
            'healthCardNumber.max' => 'El campo número de tarjeta sanitaria no puede tener más de 255 caracteres.',
            'prefix.exists' => 'El prefijo seleccionado no es válido.',
            'phone.integer' => 'El campo teléfono debe ser un número entero.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'email.max' => 'El campo email no puede tener más de 255 caracteres.',
            'language.array' => 'El campo idioma debe ser un array.',
            'language.*.string' => 'El campo idioma debe ser una cadena de texto.',
            'language.*.max' => 'El campo idioma no puede tener más de 255 caracteres.',
            'zoneId.exists' => 'La zona seleccionada no es válida.',
            'situationPersonalFamily.string' => 'El campo situación personal/familiar debe ser una cadena de texto.',
            'situationPersonalFamily.max' => 'El campo situación personal/familiar no puede tener más de 255 caracteres.',
            'healthSituation.string' => 'El campo situación de salud debe ser una cadena de texto.',
            'healthSituation.max' => 'El campo situación de salud no puede tener más de 255 caracteres.',
            'housingSituationType.string' => 'El campo tipo de situación de vivienda debe ser una cadena de texto.',
            'housingSituationType.max' => 'El campo tipo de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationStatus.string' => 'El campo estado de situación de vivienda debe ser una cadena de texto.',
            'housingSituationStatus.max' => 'El campo estado de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationNumberOfRooms.integer' => 'El campo número de habitaciones de situación de vivienda debe ser un número entero.',
            'housingSituationLocation.string' => 'El campo ubicación de situación de vivienda debe ser una cadena de texto.',
            'housingSituationLocation.max' => 'El campo ubicación de situación de vivienda no puede tener más de 255 caracteres.',
            'personalAutonomy.string' => 'El campo autonomía personal debe ser una cadena de texto.',
            'personalAutonomy.max' => 'El campo autonomía personal no puede tener más de 255 caracteres.',
            'economicSituation.string' => 'El campo situación económica debe ser una cadena de texto.',
            'economicSituation.max' => 'El campo situación económica no puede tener más de 255 caracteres.',
        ];
    }
}
