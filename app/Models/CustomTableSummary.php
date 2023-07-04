<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Sluggable\SlugOptions;

class CustomTableSummary extends Model implements Auditable
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'th',
        'td',
        'slug',
        'status',
        'sort'
    ];

    public $translatable = [
        'th', 'td',
    ];

    protected $casts = [
        'th' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model, $locale = 'en') {
                return "{$model->getTranslation('th', 'en')}";
            })
            ->saveSlugsTo('slug');
    }

    public function scopeActive($query, $status = true)
    {
        $query->where('status', $status);
    }

    public function customTable()
    {
        return $this->belongsTo(CustomTable::class);
    }
}
