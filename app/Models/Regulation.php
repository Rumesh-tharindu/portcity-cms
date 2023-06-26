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

class Regulation extends Model implements Auditable, HasMedia
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = ['title', 'description', 'slug', 'featured', 'status', 'sort'];

    public $translatable = ['title', 'description'];

    protected $casts = ['title' => 'array'];

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
        $this->addMediaCollection('pdf')
        ->singleFile();
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }
}
