<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WhyGefen extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['description'];
    protected $fillable = ['photo_1','photo_2','photo_3','why_gefen_id'];
}
