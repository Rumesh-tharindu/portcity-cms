<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PublicationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            $this->mergeWhen($request->user()->isAdmin(), [
                'newsSource' => [
                    'source' => $this->source,
                    'date' => $this->published_at->format('M d, Y'),
                ],
                'summary' => $this->summary,
                'description' => $this->description,
            ]),
            $this->mergeWhen($this->getFirstMedia('featured_image'), [
                'thumbnail' => $this->getFirstMediaUrl('featured_image'),
            ]),
            $this->mergeWhen($this->getMedia('slider_images'),
                function () {
                    $medias = $this->getMedia('slider_images');
                    $slider_images = $medias->sortBy(function ($media, $key) {
                        return $media->getCustomProperty('sort');
                    });
                    $images = [];
                    $slider_images->each(function ($item, $key) {
                        $images[] = $item->getFullUrl();
                    });

                    return ['slider_images' => $images ?? null];
                }),
            'slug' => $this->slug,
            'featured' => $this->featured,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
