<?php

namespace App\Http\Requests\Zone;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ZoneUpdateRequest",
 *     type="object",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre de la zona",
 *         example="Ronny Feest",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripcion de la zona",
 *         example="Veniam neque libero sed sunt aut porro unde.",
 *          maxLength=255
 *     ),
 *     @OA\Property(
 *         property="location",
 *         type="string",
 *         description="Ubicacion de la zona",
 *         example="A Coruña",
 *         maxLength=255
 *     )
 * )
 */
class ZoneUpdateRequest extends FormRequest
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
        $current = $this->route('zone');

        return [
            'name' => 'string|unique:zones,name,'. $current->name .',name|max:255',
            'description' => 'string|max:255',
            'location' => 'string|max:255',
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
            'name.unique' => 'Este nombre ya está en uso. Por favor, elige otro.',
            'name.string' => 'El campo "Nombre" debe ser una cadena de caracteres.',
            'name.max' => 'El campo "Nombre" no puede superar los 255 caracteres.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',
            'description.string' => 'El campo "Descripción" debe ser una cadena de caracteres.',
            'location.max' => 'La ubicación no puede superar los 255 caracteres.',
            'location.string' => 'El campo "Ubicación" debe ser una cadena de caracteres.',
        ];
    }
}
