<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $guarded = [];
}
