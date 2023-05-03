<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;


class Paylasim extends Model implements TranslatableContract
{
    use Translatable,LogsActivity;
    public $translatedAttributes = ['title', 'content','description','keywords'];
    protected $fillable = ['user_id','category_id','view_count','photo','admin_status','admin_id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['category_id','photo']);
    }
}
