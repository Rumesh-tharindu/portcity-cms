<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\SlugOptions;

class FaqType extends Model implements Auditable, HasMedia
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = ['type', 'slug', 'status', 'sort'];

    public $translatable = ['type',];

    protected $casts = ['type' => 'array'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model, $locale = 'en') {
                return "{$model->getTranslation('type', 'en')}";
            })
            ->saveSlugsTo('slug');
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
