<?php

namespace App\Http\Requests\Zone;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|unique:zone|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
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
            'name.required' => 'El camp "Nom" és obligatori.',
            'name.unique' => 'Aquest nom ja està en ús. Si us plau, tria un altre.',
            'description.required' => 'El camp "Descripció" és obligatori.',
            'description.max' => 'La descripció no pot superar els 255 caràcters.',
            'location.required' => 'El camp "Ubicació" és obligatori.',
            'location.max' => 'La ubicació no pot superar els 255 caràcters.',
        ];
    }
}
