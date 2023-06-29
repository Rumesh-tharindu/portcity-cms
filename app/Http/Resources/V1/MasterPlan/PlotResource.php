<?php

namespace App\Http\Resources\V1\MasterPlan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlotResource extends JsonResource
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
            'plan' => $this->plan->title,
            'plot_number' => $this->plot_number,
            'title' => $this->title,
            'description' => $this->description,
            'map_image' => $this->getFirstMediaUrl('map_image'),
            'slug' => $this->slug,
            //'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
