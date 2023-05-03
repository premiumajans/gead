<?php

namespace App\Models;

use App\Models\Backend\Service;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServiceComponent extends Model implements TranslatableContract
{
    use Translatable;
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public $translatedAttributes = ['name'];
    protected $guarded = [];
    public $timestamps = false;
}
