<?php

namespace App\Http\Resources\V1\FaqType;

use App\Http\Resources\V1\Faq\FaqResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqTypeResource extends JsonResource
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
            'title' => $this->type,
            'faqs' => FaqResource::collection($this->whenLoaded('faqs')),
            'slug' => $this->slug,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
