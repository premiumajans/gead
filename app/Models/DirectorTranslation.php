<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class DirectorTranslation extends Model
{
    use LogsActivity;
    public $timestamps = false;
    protected $fillable = ['name', 'position'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name','position']);
    }
}
