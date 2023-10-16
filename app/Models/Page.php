<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\MailManager;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Sluggable\SlugOptions;

class Page extends Model implements Auditable
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable;

    protected $fillable = ['name', 'slug', 'status', 'sort'];

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

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

/*     public function emails()
    {
        return $this->morphMany(MailManager::class, 'mailable');
    } */

    public function inquiries()
    {
        return $this->morphMany(Inquiry::class, 'inquiry');
    }

}
