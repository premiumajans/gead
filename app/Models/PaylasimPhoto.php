<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PaylasimPhoto extends Model
{
    use LogsActivity;

    protected $fillable = ['paylasim_id','photo'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo']);
    }
}
