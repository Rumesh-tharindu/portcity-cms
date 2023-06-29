<?php

namespace App\Http\Resources\V1\Publication;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
            'category' => $this->category->name,
            'title' => $this->title,
            $this->mergeWhen(in_array($this->category->slug, ['press-releases', 'media-coverage']), [
                'newsSource' => [
                    'source' => parse_url($this->source)['host'],
                    'date' => $this->published_at->format('F d, Y'),
                ],
                'summary' => $this->summary,
                'description' => $this->description,
            ]),
            'thumbnail' => $this->getFirstMediaUrl('featured_image'),
            $this->mergeWhen(in_array($this->category->slug, ['press-releases', 'media-coverage']),
                function () {
                    $medias = $this->getMedia('slider_images');
                    $slider_images = $medias->sortBy(function ($media, $key) {
                        return $media->getCustomProperty('sort');
                    });

                    $images['slider_images'] = [];

                    foreach($slider_images as $item){
                        $images['slider_images'][$item->getCustomProperty('sort')] = $item->getFullUrl();
                    }

                    return $images;
                }),
            $this->mergeWhen(in_array($this->category->slug, ['media-kit']), [
                'pdf' => $this->getFirstMediaUrl('pdf'),
            ]),
            'slug' => $this->slug,
            'featured' => $this->featured,
            //'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
