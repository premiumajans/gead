<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class VideoPhotos extends Model
{
    public function video()
    {
        $this->belongsTo(Video::class);
    }
    protected $guarded = [];
    public $timestamps = false;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo']);
    }
}
