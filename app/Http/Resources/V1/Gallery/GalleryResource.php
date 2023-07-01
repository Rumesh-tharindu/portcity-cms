<?php

namespace App\Http\Resources\V1\Gallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'year' => $this->year,
            'slug' => $this->slug,
            $this->mergeWhen($this->getMedia('images')->isNotEmpty(),
                function () {
                    $medias = $this->getMedia('images');
                    $images = $medias->sortBy(function ($media, $key) {
                        return $media->getCustomProperty('sort');
                    });

                    $img['images'] = [];

                    foreach($images as $key => $item){
                        $img['images'][$key] = $item->getFullUrl();
                    }

                    return $img;
                }),
            'video_urls' => explode(",", preg_replace( "/\r|\n/", "", $this->video_urls)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
