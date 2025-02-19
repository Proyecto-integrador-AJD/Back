<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="PatientUpdateRequest",
 *     type="object",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del paciente",
 *         example="Juan",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Apellido del paciente",
 *         example="Pérez",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="birthDate",
 *         type="string",
 *         format="date",
 *         description="Fecha de nacimiento del paciente",
 *         example="1980-05-15"
 *     ),
 *     @OA\Property(
 *         property="addressStreet",
 *         type="string",
 *         description="Calle de la dirección del paciente",
 *         example="Calle Mayor",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="addressNumber",
 *         type="integer",
 *         description="Número de la dirección del paciente",
 *         example=123
 *     ),
 *     @OA\Property(
 *         property="addressPostalCode",
 *         type="integer",
 *         description="Código postal de la dirección del paciente",
 *         example=28001
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Correo electrónico del paciente",
 *         example="juan.perez@example.com",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="integer",
 *         description="Número de teléfono del paciente",
 *         example=600123456
 *     ),
 *     @OA\Property(
 *         property="healthCardNumber",
 *         type="string",
 *         description="Número de la tarjeta sanitaria del paciente",
 *         example="1234567890",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="zoneId",
 *         type="integer",
 *         description="ID de la zona asignada al paciente",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="language",
 *         type="array",
 *         @OA\Items(
 *             type="string",
 *             description="Idioma preferido",
 *             example="Español"
 *         )
 *     ),
 *     @OA\Property(
 *         property="economicSituation",
 *         type="string",
 *         description="Situación económica del paciente",
 *         example="Ingresos bajos",
 *         maxLength=255
 *     )
 * )
 */
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
            'language.*' => 'string|exists:languages,name|max:255',
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
    /**
     * Obté els missatges d'error personalitzats per a cada regla.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'lastName.string' => 'El apellido debe ser una cadena de texto.',
            'lastName.max' => 'El apellido no puede tener más de 255 caracteres.',
            'birthDate.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'addressStreet.string' => 'La calle de la dirección debe ser una cadena de texto.',
            'addressStreet.max' => 'La calle de la dirección no puede tener más de 255 caracteres.',
            'addressNumber.integer' => 'El número de la dirección debe ser un número entero.',
            'addressFloor.string' => 'El piso de la dirección debe ser una cadena de texto.',
            'addressFloor.max' => 'El piso de la dirección no puede tener más de 255 caracteres.',
            'addressDoor.string' => 'La puerta de la dirección debe ser una cadena de texto.',
            'addressDoor.max' => 'La puerta de la dirección no puede tener más de 255 caracteres.',
            'addressPostalCode.integer' => 'El código postal de la dirección debe ser un número entero.',
            'addressCity.string' => 'La ciudad de la dirección debe ser una cadena de texto.',
            'addressCity.max' => 'La ciudad de la dirección no puede tener más de 255 caracteres.',
            'addressProvince.string' => 'La provincia de la dirección debe ser una cadena de texto.',
            'addressProvince.max' => 'La provincia de la dirección no puede tener más de 255 caracteres.',
            'addressCountry.string' => 'El país de la dirección debe ser una cadena de texto.',
            'addressCountry.max' => 'El país de la dirección no puede tener más de 255 caracteres.',
            'healthCardNumber.string' => 'El número de la tarjeta sanitaria debe ser una cadena de texto.',
            'healthCardNumber.unique' => 'El número de la tarjeta sanitaria ya ha sido utilizado.',
            'healthCardNumber.max' => 'El número de la tarjeta sanitaria no puede tener más de 255 caracteres.',
            'prefix.exists' => 'El prefijo seleccionado no es válido.',
            'phone.integer' => 'El teléfono debe ser un número entero.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya ha sido utilizado.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'language.array' => 'El idioma debe ser un array.',
            'language.*.string' => 'El idioma debe ser una cadena de texto.',
            'language.*.max' => 'El idioma no puede tener más de 255 caracteres.',
            'zoneId.exists' => 'El ID de zona seleccionado no es válido.',
            'situationPersonalFamily.string' => 'La situación personal/familiar debe ser una cadena de texto.',
            'situationPersonalFamily.max' => 'La situación personal/familiar no puede tener más de 255 caracteres.',
            'healthSituation.string' => 'La situación de salud debe ser una cadena de texto.',
            'healthSituation.max' => 'La situación de salud no puede tener más de 255 caracteres.',
            'housingSituationType.string' => 'El tipo de situación de vivienda debe ser una cadena de texto.',
            'housingSituationType.max' => 'El tipo de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationStatus.string' => 'El estado de situación de vivienda debe ser una cadena de texto.',
            'housingSituationStatus.max' => 'El estado de situación de vivienda no puede tener más de 255 caracteres.',
            'housingSituationNumberOfRooms.integer' => 'El número de habitaciones en la situación de vivienda debe ser un número entero.',
            'housingSituationLocation.string' => 'La ubicación de la situación de vivienda debe ser una cadena de texto.',
            'housingSituationLocation.max' => 'La ubicación de la situación de vivienda no puede tener más de 255 caracteres.',
            'personalAutonomy.string' => 'La autonomía personal debe ser una cadena de texto.',
            'personalAutonomy.max' => 'La autonomía personal no puede tener más de 255 caracteres.',
            'economicSituation.string' => 'La situación económica debe ser una cadena de texto.',
            'economicSituation.max' => 'La situación económica no puede tener más de 255 caracteres.',
        ];
    }
}
