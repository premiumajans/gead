<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Register extends Model
{
    public function main(): void
    {
        $this->belongsTo(Content::class);
    }
    protected $guarded = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['photo']);
    }
}
