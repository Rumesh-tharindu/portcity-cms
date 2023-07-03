<?php

namespace App\Http\Resources\V1\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'designation' => $this->designation,
            'slug' => $this->slug,
            'sort' => $this->sort,
            'avatar' => $this->getFirstMediaUrl('avatar'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
