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
        return [
            'name' => 'required|max:255',
            'lastName' => 'required|max:255',
            'birthDate' => 'required|date',
            'addressStreet' => 'required|max:255',
            'addressNumber' => 'required|integer',
            'addressFloor' => 'nullable|max:255',
            'addressDoor' => 'nullable|max:255',
            'addressPostalCode' => 'required|integer',
            'addressCity' => 'required|max:255',
            'addressProvince' => 'required|max:255',
            'addressCountry' => 'required|max:255',
            'dni' => 'required|unique:patients|max:255',
            'healthCardNumber' => 'required|unique:patients|max:255',
            'prefix' => 'required|string',
            'phone' => 'required|integer',
            'email' => 'required|unique:patients|max:255',
            'zoneId' => 'required|exists:zones,id',
            'situationPersonalFamily' => 'required|max:255',
            'healthSituation' => 'required|max:255',
            'housingSituationType' => 'required|max:255',
            'housingSituationStatus' => 'required|max:255',
            'housingSituationNumberOfRooms' => 'required|integer',
            'housingSituationLocation' => 'required|max:255',
            'personalAutonomy' => 'required|max:255',
            'economicSituation' => 'required|max:255',
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
            'name.max' => 'El nom no pot superar els 255 caràcters.',
            'lastName.required' => 'El camp "Cognom" és obligatori.',
            'lastName.max' => 'El cognom no pot superar els 255 caràcters.',
            'birthDate.required' => 'El camp "Data de naixement" és obligatori.',
            'birthDate.date' => 'El camp "Data de naixement" ha de ser una data vàlida.',
            'addressStreet.required' => 'El camp "Carrer" és obligatori.',
            'addressStreet.max' => 'El carrer no pot superar els 255 caràcters.',
            'addressNumber.required' => 'El camp "Número" és obligatori.',
            'addressNumber.integer' => 'El camp "Número" ha de ser un número enter.',
            'addressFloor.max' => 'El pis no pot superar els 255 caràcters.',
            'addressDoor.max' => 'La porta no pot superar els 255 caràcters.',
            'addressPostalCode.required' => 'El camp "Codi postal" és obligatori.',
            'addressPostalCode.integer' => 'El camp "Codi postal" ha de ser un número enter.',
            'addressCity.required' => 'El camp "Ciutat" és obligatori.',
            'addressCity.max' => 'La ciutat no pot superar els 255 caràcters.',
            'addressProvince.required' => 'El camp "Província" és obligatori.',
            'addressProvince.max' => 'La província no pot superar els 255 caràcters.',
            'addressCountry.required' => 'El camp "País" és obligatori.',
            'addressCountry.max' => 'El país no pot superar els 255 caràcters.',
            'dni.required' => 'El camp "DNI" és obligatori.',
            'dni.unique' => 'Aquest DNI ja està en ús. Si us plau, tria un altre.',
            'dni.max' => 'El DNI no pot superar els 255 caràcters.',
            'healthCardNumber.required' => 'El camp "Número de targeta sanitària" és obligatori.',
            'healthCardNumber.unique' => 'Aquest número de targeta sanitària ja està en ús. Si us plau, tria un altre.',
            'healthCardNumber.max' => 'El número de targeta sanitària no pot superar els 255 caràcters.',
            'prefix.required' => 'El camp "Prefix" és obligatori.',
            'phone.required' => 'El camp "Telèfon" és obligatori.',
            'phone.integer' => 'El camp "Telèfon" ha de ser un número enter.',
            'email.required' => 'El camp "Email" és obligatori.',
            'email.unique' => 'Aquest email ja està en ús. Si us plau, tria un altre.',
            'email.max' => 'L\'email no pot superar els 255 caràcters.',
            'zoneId.required' => 'El camp "Zona" és obligatori.',
            'zoneId.exists' => 'La zona seleccionada no és vàlida.',
            'situationPersonalFamily.required' => 'El camp "Situació personal i familiar" és obligatori.',
            'situationPersonalFamily.max' => 'La situació personal i familiar no pot superar els 255 caràcters.',
            'healthSituation.required' => 'El camp "Situació de salut" és obligatori.',
            'healthSituation.max' => 'La situació de salut no pot superar els 255 caràcters.',
            'housingSituationType.required' => 'El camp "Tipus de situació d\'habitatge" és obligatori.',
            'housingSituationType.max' => 'El tipus de situació d\'habitatge no pot superar els 255 caràcters.',
            'housingSituationStatus.required' => 'El camp "Estat de situació d\'habitatge" és obligatori.',
            'housingSituationStatus.max' => 'L\'estat de situació d\'habitatge no pot superar els 255 caràcters.',
            'housingSituationNumberOfRooms.required' => 'El camp "Nombre d\'habitacions" és obligatori.',
            'housingSituationNumberOfRooms.integer' => 'El camp "Nombre d\'habitacions" ha de ser un número enter.',
            'housingSituationLocation.required' => 'El camp "Ubicació de situació d\'habitatge" és obligatori.',
            'housingSituationLocation.max' => 'La ubicació de situació d\'habitatge no pot superar els 255 caràcters.',
            'personalAutonomy.required' => 'El camp "Autonomia personal" és obligatori.',
            'personalAutonomy.max' => 'L\'autonomia personal no pot superar els 255 caràcters.',
            'economicSituation.required' => 'El camp "Situació econòmica" és obligatori.',
            'economicSituation.max' => 'La situació econòmica no pot superar els 255 caràcters.',
        ];
    }
}
