<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Translatable\HasTranslations;

trait CommonModelTrait
{
    use SoftDeletes, HasTranslations, HasTranslatableSlug;
}
