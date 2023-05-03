<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Director extends Model implements TranslatableContract
{
    use Translatable,LogsActivity;
    public $translatedAttributes = ['name', 'position'];
    protected $fillable = ['photo'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo']);
    }
}
