<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PrayerTimesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->resource['code'],
            'status' => $this->resource['status'],
            'data' => collect($this->resource['data'])->map(function($item) {
                return [
                    'timings' => $item['timings'],
                    'date' => $item['date'],
                    'meta' => $item['meta']
                ];
            })
        ];
    }
}
