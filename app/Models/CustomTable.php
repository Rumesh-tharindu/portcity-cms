<?php

namespace App\Models;

use App\Traits\CommonModelTrait;
use App\Traits\HtmlTableToJsonTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Sluggable\SlugOptions;

class CustomTable extends Model implements Auditable
{
    use HasFactory, CommonModelTrait, \OwenIt\Auditing\Auditable, HtmlTableToJsonTrait;

    protected $fillable = [
        'name',
        'table_data',
        'table_json',
        'slug',
        'status',
        'sort'
    ];

    public $translatable = [
        'name', 'table_data', 'table_json',
    ];

    protected $casts = [
        'name' => 'array',
        'table_json' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $table_data_translations = $model->getTranslations('table_data');

            $table_data_translations_arr = [];
            foreach($table_data_translations as $key => $item){
                $table_data_translations_arr[$key] = self::htmlTableToJson($item);
            }
            $model->table_json = $table_data_translations_arr;
            $model->saveQuietly();

        });
    }

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

    public function product()
    {
        return $this->morphTo('model');
    }

}
