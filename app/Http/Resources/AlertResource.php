<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patientId' => $this->patientId,
            'patient' => new PatientResource($this->patient ),
            'type' => $this->type,
            'subType' => $this->subType,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'isRecurring' => $this->isRecurring,
            'recurrenceType' => $this->recurrenceType,
            'recurrence' => $this->recurrence,
        ];
    }
}