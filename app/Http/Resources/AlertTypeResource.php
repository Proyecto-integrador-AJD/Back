<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'name' => $this->name,
            'spanishName' => $this->spanishName,
            'valencianName' => $this->valencianName,
            'subtypes' => AlertSubtypeResource::collection($this->subtypes),
        ];
    }
}