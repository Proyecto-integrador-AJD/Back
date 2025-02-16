<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'name' => $this->name,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'prefix' => new PrefixResource($this->prefix),
            'phone' => $this->phone,
            'patientId' => $this->patientId,
            'relationship' => new RelationshipResource($this->relationship),
        ];
    }
}