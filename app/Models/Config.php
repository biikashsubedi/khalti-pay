<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::saving(function () {
            Cache::forget('logo');
            Cache::forget('logo1');
            Cache::forget('logo2');
            Cache::forget('title');
            Cache::forget('site_header');
        });
    }

    public function isFile($type)
    {
        return strtolower($type) == 'file';
    }

    public function isText($type)
    {
        return strtolower($type) == 'text';
    }

    public function isBoolean($type)
    {
        return strtolower($type) == 'boolean';
    }

    public function getUrlAttribute()
    {
        return \URL::to("/storage" . $this->value);
    }
}
