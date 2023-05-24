<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'detail',
        'hits',
        'type',
        'status'
    ];

    static $apiType = ['android', 'ios'];

    static $ios = 'ios';
    static $android = 'android';

    public function getApiKey($key)
    {
        return self::where('key', $key)->whereStatus(1)->first();
    }
}
