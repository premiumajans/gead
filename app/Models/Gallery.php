<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Gallery extends Model implements TranslatableContract
{
    use Translatable, LogsActivity;

    public $translatedAttributes = ['name'];
    protected $fillable = ['photo','status'];

    public function photos()
    {
        return $this->hasMany(GalleryPhotos::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
