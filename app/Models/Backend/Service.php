<?php

namespace App\Models\Backend;

use App\Models\ServiceComponent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['photo', 'alt', 'status'];

    public function component()
    {
        return $this->hasOne(ServiceComponent::class);
    }
}
