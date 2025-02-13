<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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

    // public function authentication(): bool
    // {
    //     return true; // Permitir la autenticación por token
    // }

    /**
     * Obté les regles de validació aplicables a la petició.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'addressStreet' => 'required|string|max:255',
            'addressNumber' => 'required|integer',
            'addressFloor' => 'nullable|string|max:255',
            'addressDoor' => 'nullable|string|max:255',
            'addressPostalCode' => 'required|string|max:255',
            'addressCity' => 'required|string|max:255',
            'addressProvince' => 'required|string|max:255',
            'addressCountry' => 'required|string|max:255',
            'dni' => 'required|string|unique:patients,dni|max:255',
            'healthCardNumber' => 'required|string|unique:patients,healthCardNumber|max:255',
            'prefix' => 'exists:prefixes,prefix',
            'phone' => 'required|integer',
            'email' => 'required|email|unique:patients,email|max:255',
            'language' => 'required|array',
            'language.*' => 'string|max:255',
            'zoneId' => 'required|exists:zones,id',
            'situationPersonalFamily' => 'required|string|max:255',
            'healthSituation' => 'required|string|max:255',
            'housingSituationType' => 'required|string|max:255',
            'housingSituationStatus' => 'required|string|max:255',
            'housingSituationNumberOfRooms' => 'required|integer',
            'housingSituationLocation' => 'required|string|max:255',
            'personalAutonomy' => 'required|string|max:255',
            'economicSituation' => 'required|string|max:255',
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
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'lastName.required' => 'El campo apellido es obligatorio.',
            'lastName.string' => 'El campo apellido debe ser una cadena de texto.',
            'lastName.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            'birthDate.required' => 'El campo fecha de nacimiento es obligatorio.',
            'birthDate.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'addressStreet.required' => 'El campo dirección es obligatorio.',
            'addressStreet.string' => 'El campo dirección debe ser una cadena de texto.',
            'addressStreet.max' => 'El campo dirección no puede tener más de 255 caracteres.',
            'addressNumber.required' => 'El campo número de dirección es obligatorio.',
            'addressNumber.integer' => 'El campo número de dirección debe ser un número entero.',
            'addressFloor.nullable' => 'El campo piso de dirección debe ser nulo.',
            'addressFloor.string' => 'El campo piso de dirección debe ser una cadena de texto.',
            'addressFloor.max' => 'El campo piso de dirección no puede tener más de 255 caracteres.',
            'addressDoor.nullable' => 'El campo puerta de dirección debe ser nulo.',
            'addressDoor.string' => 'El campo puerta de dirección debe ser una cadena de texto.',
            'addressDoor.max' => 'El campo puerta de dirección no puede tener más de 255 caracteres.',
            'addressPostalCode.required' => 'El campo código postal es obligatorio.',
            'addressPostalCode.string' => 'El campo código postal debe ser una cadena de texto.',
            'addressPostalCode.max' => 'El campo código postal no puede tener más de 255 caracteres.',
            'addressCity.required' => 'El campo ciudad es obligatorio.',
            'addressCity.string' => 'El campo ciudad debe ser una cadena de texto.',
            'addressCity.max' => 'El campo ciudad no puede tener más de 255 caracteres.',
            'addressProvince.required' => 'El campo provincia es obligatorio.',
            'addressProvince.string' => 'El campo provincia debe ser una cadena de texto.',
            'addressProvince.max' => 'El campo provincia no puede tener más de 255 caracteres.',
            'addressCountry.required' => 'El campo país es obligatorio.',
            'addressCountry.string' => 'El campo país debe ser una cadena de texto.',
            'addressCountry.max' => 'El campo país no puede tener más de 255 caracteres.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.string' => 'El campo DNI debe ser una cadena de texto.',
            'dni.unique' => 'El campo DNI ya ha sido tomado.',
            'dni.max' => 'El campo DNI no puede tener más de 255 caracteres.',
            'healthCardNumber.required' => 'El campo número de tarjeta sanitaria es obligatorio.',
            'healthCardNumber.string' => 'El campo número de tarjeta sanitaria debe ser una cadena de texto.',
            'healthCardNumber.unique' => 'El campo número de tarjeta sanitaria ya ha sido tomado.',
            'healthCardNumber.max' => 'El campo número de tarjeta sanitaria no puede tener más de 255 caracteres.',
            'prefix.exists' => 'El prefijo seleccionado es inválido.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.integer' => 'El campo teléfono debe ser un número entero.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El campo correo electrónico ya ha sido tomado.',
            'email.max' => 'El campo correo electrónico no puede tener más de 255 caracteres.',
            'language.required' => 'El campo idioma es obligatorio.',
            'language.array' => 'El campo idioma debe ser un arreglo.',
            'language.*.string' => 'El campo idioma debe ser una cadena de texto.',
            'language.*.max' => 'El campo idioma no puede tener más de 255 caracteres.',
            'zoneId.required' => 'El campo ID de zona es obligatorio.',
            'zoneId.exists' => 'El ID de zona seleccionado es inválido.',
            'situationPersonalFamily.required' => 'El campo situación personal/familiar es obligatorio.',
            'situationPersonalFamily.string' => 'El campo situación personal/familiar debe ser una cadena de texto.',
            'situationPersonalFamily.max' => 'El campo situación personal/familiar no puede tener más de 255 caracteres.',
            'healthSituation.required' => 'El campo situación de salud es obligatorio.',
            'healthSituation.string' => 'El campo situación de salud debe ser una cadena de texto.',
            'healthSituation.max' => 'El campo situación de salud no puede tener más de 255 caracteres.',
            'housingSituationType.required' => 'El campo tipo de situación de vivienda es obligatorio.',
            'housingSituationType.string' => 'El campo tipo de situación de vivienda debe ser una cadena de texto.',
            'housingSituationType.max' => 'El campo tipo de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationStatus.required' => 'El campo estado de situación de vivienda es obligatorio.',
            'housingSituationStatus.string' => 'El campo estado de situación de vivienda debe ser una cadena de texto.',
            'housingSituationStatus.max' => 'El campo estado de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationNumberOfRooms.required' => 'El campo número de habitaciones de situación de vivienda es obligatorio.',
            'housingSituationNumberOfRooms.integer' => 'El campo número de habitaciones de situación de vivienda debe ser un número entero.',
            'housingSituationLocation.required' => 'El campo ubicación de situación de vivienda es obligatorio.',
            'housingSituationLocation.string' => 'El campo ubicación de situación de vivienda debe ser una cadena de texto.',
            'housingSituationLocation.max' => 'El campo ubicación de situación de vivienda no puede tener más de 255 caracteres.',
            'personalAutonomy.required' => 'El campo autonomía personal es obligatorio.',
            'personalAutonomy.string' => 'El campo autonomía personal debe ser una cadena de texto.',
            'personalAutonomy.max' => 'El campo autonomía personal no puede tener más de 255 caracteres.',
            'economicSituation.required' => 'El campo situación económica es obligatorio.',
            'economicSituation.string' => 'El campo situación económica debe ser una cadena de texto.',
            'economicSituation.max' => 'El campo situación económica no puede tener más de 255 caracteres.',
        ];
    }
}
