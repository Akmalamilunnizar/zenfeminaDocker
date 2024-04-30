<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CycleResource extends JsonResource
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
            'type' => $this->type,
            'cycle_length' => $this->cycle_length,
            'period_length' => $this->period_length,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
