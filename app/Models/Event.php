<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;

class Event extends Model implements Auditable, HasMedia
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = [
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'title',
        'description',
        'location',
        'ticket',
        'slug',
        'status',
        'one_day',
        'sort'
    ];

    public $translatable = ['title', 'description', 'location', 'ticket'];

    protected $casts = ['title' =>'array', 'date_from' => 'date:Y-m-d', 'date_to' => 'date:Y-m-d', ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model, $locale = 'en') {
                return "{$model->getTranslation('title', 'en')}";
            })
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
        ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued()
            ->performOnCollections('featured_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
        ->singleFile();
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }

    public function getDateRangeAttribute()
    {
        return implode(" - ", [
            \Carbon\Carbon::parse($this->date_from)->format('m/d/Y'),
            \Carbon\Carbon::parse($this->date_to)->format('m/d/Y')
        ]);
    }

}
