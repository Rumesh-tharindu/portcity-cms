<?php

namespace App\Models;

use App\Repositories\CommonRepository;
use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements Auditable, HasMedia
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = ['name', 'page_id', 'section', 'slug', 'status', 'sort'];

    public $translatable = ['name'];

    protected $casts = ['name' => 'array'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom(function ($model, $locale = 'en') {
            return "{$model->getTranslation('name', 'en')}";
        })
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued()
            ->performOnCollections('category_featured_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_featured_image')
            ->singleFile();
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }

    public function page()
    {
        return $this->belongsTo(Category::class);
    }


}
