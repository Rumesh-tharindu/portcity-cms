<?php

namespace App\Http\Resources\V1\Category;

use App\Http\Resources\V1\Publication\PublicationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            //'featured_image' => $this->getFirstMediaUrl('featured_image'),
            'slug' => $this->slug,
            'publications' => new PublicationResource($this->whenLoaded('publications')),
            //'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
