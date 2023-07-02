<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\SlugOptions;

class Faq extends Model implements Auditable, HasMedia
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $fillable = ['question', 'answer', 'slug', 'status', 'sort'];

    public $translatable = ['question', 'answer'];

    protected $casts = ['question' => 'array'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model, $locale = 'en') {
                return "{$model->getTranslation('question', 'en')}";
            })
            ->saveSlugsTo('slug');
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }
}
