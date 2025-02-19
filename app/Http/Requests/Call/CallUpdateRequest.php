<?php

namespace App\Http\Requests\Call;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CallUpdateRequest",
 *     type="object",
 *     @OA\Property(
 *         property="date",
 *         type="string",
 *         format="date-time",
 *         description="Fecha y hora de la llamada (formato Y-m-d H:i:s)",
 *         example="2025-02-19 15:30:00"
 *     ),
 *     @OA\Property(
 *         property="patientId",
 *         type="integer",
 *         description="ID del paciente al que se le realizó la llamada",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="userId",
 *         type="integer",
 *         description="ID del usuario que realizó la llamada",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="incoming",
 *         type="boolean",
 *         description="Indica si la llamada fue entrante (true) o saliente (false)",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         description="Tipo de la llamada",
 *         example="emergency"
 *     ),
 *     @OA\Property(
 *         property="subType",
 *         type="string",
 *         description="Subtipo de la llamada (opcional)",
 *         example="heart attack"
 *     ),
 *     @OA\Property(
 *         property="alertId",
 *         type="integer",
 *         description="ID de la alerta asociada a la llamada (opcional)",
 *         example=3
 *     ),
 *     @OA\Property(
 *         property="duration",
 *         type="integer",
 *         description="Duración de la llamada en segundos",
 *         example=120
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripción adicional de la llamada",
 *         example="Paciente con dificultad respiratoria"
 *     )
 * )
 */
class CallUpdateRequest extends FormRequest
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
            'date' => 'date',
            'patientId' => 'exists:patients,id',
            'userId' => 'exists:users,id',
            'incoming' => 'boolean',
            'type' => 'string',
            'subType' => 'string',
            'alertId' => 'nullable|exists:alerts,id',
            'duration' => 'integer',
            'description' => 'string',
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
            'date.date' => 'El camp "Data" ha de ser una data vàlida.',
            'patientId.exists' => 'L\'ID del pacient proporcionat no és vàlid.',
            'userId.exists' => 'L\'ID de l\'usuari proporcionat no és vàlid.',
            'incoming.boolean' => 'El camp "Entrant" ha de ser un valor booleà.',
            'type.string' => 'El camp "Tipus" ha de ser una cadena de caràcters.',
            'subType.string' => 'El camp "Subtipus" ha de ser una cadena de caràcters.',
            'alertId.exists' => 'L\'ID de l\'alerta proporcionat no és vàlid.',
            'duration.integer' => 'El camp "Durada" ha de ser un valor enter.',
            'description.string' => 'El camp "Descripció" ha de ser una cadena de caràcters.',
        ];
    }
}
