<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gallery extends Model implements Auditable, HasMedia
{
    use HasFactory, HasSlug, SoftDeletes, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = ['year', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('year')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
        ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued()
            ->performOnCollections('images');
        $this->addMediaConversion('preview')
        ->width(300)
        ->height(300)
        ->extractVideoFrameAtSecond(1)
        ->performOnCollections('video');
    }

}
