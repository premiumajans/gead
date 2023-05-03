<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Forigner extends Model
{
    use LogsActivity;
    protected $guarded = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name','phone','location']);
    }
}
