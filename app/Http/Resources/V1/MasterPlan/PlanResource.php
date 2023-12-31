<?php

namespace App\Http\Resources\V1\MasterPlan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'map_image' => $this->getFirstMediaUrl('map_image'),
            'slug' => $this->slug,
            'plots' => PlotResource::collection($this->whenLoaded('plots')),
            //'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
