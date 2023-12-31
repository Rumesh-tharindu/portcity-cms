<?php

namespace App\Http\Resources\V1\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EventResource extends JsonResource
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
            /*             'date_from' => $this->date_from->format('Y-m-d'),
            'date_to' => $this->date_to->format('Y-m-d'),
            'time_from' => Carbon::parse($this->time_from)->format('h:i A'),
            'time_to' => Carbon::parse($this->time_to)->format('h:i A'), */
            'title' => $this->title,
            'eventInfo' => [
            'date' => $this->date_from->format('d F') . " to " . $this->date_to->format('d F Y'),
            'time' => Carbon::parse($this->time_from)->format('h:ia') . " to " . Carbon::parse($this->time_to)->format('h:ia'),
            'description' => $this->description,
            'location' => $this->location,
            'ticket' => $this->ticket,
            ],
            'slug' => $this->slug,
            'one_day' => $this->one_day,
            'thumbnail' => $this->getFirstMediaUrl('featured_image'),
            $this->mergeWhen($this->getMedia('slider_images')->isNotEmpty(),
                function () {
                    $medias = $this->getMedia('slider_images');
                    $slider_images = $medias->sortBy(function ($media, $key) {
                        return $media->getCustomProperty('sort');
                    });

                    $images['slider_images'] = [];

                    foreach($slider_images as $key => $item){
                        $images['slider_images'][$key] = $item->getFullUrl();
                    }

                    return $images;
                }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
