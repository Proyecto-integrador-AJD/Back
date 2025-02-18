<?php

namespace App\Http\Requests\Zone;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="StoreEquipRequest",
 *     type="object",
 *     required={"name", "description", "location"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre de la zona",
 *         example="Ronny Feest"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripcion de la zona",
 *         example="Veniam neque libero sed sunt aut porro unde."
 *     ),
 *     @OA\Property(
 *         property="location",
 *         type="string",
 *         description="Ubicacion de la zona",
 *         example="A Coruña"
 *     )
 * )
 */
class ZoneStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:zones,name|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
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
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'name.string' => 'El campo "Nombre" debe ser una cadena de caracteres.',
            'name.unique' => 'Este nombre ya está en uso. Por favor, elija otro.',
            'description.required' => 'El campo "Descripción" es obligatorio.',
            'description.string' => 'El campo "Descripción" debe ser una cadena de caracteres.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',
            'location.required' => 'El campo "Ubicación" es obligatorio.',
            'location.string' => 'El campo "Ubicación" debe ser una cadena de caracteres.',
            'location.max' => 'La ubicación no puede superar los 255 caracteres.',
        ];
    }
}
