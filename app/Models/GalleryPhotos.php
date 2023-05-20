<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class GalleryPhotos extends Model
{
    public function gallery()
    {
        $this->belongsTo(Gallery::class);
    }
    protected $guarded = [];
    public $timestamps = false;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo']);
    }
}
