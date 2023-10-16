<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Inquiry extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = ['reference','first_name', 'last_name', 'email', 'contact_number', 'country', 'company', 'type', 'message', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->reference = Carbon::now()->valueOf();
        });
    }

    public function inquiry()
    {
        return $this->morphTo();
    }
}
