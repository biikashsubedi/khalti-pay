<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'code',
        'icon',
        'mode',
        'sandbox',
        'live',
        'web_status',
        'api_status',
        'default',
    ];

    public $casts = [
        'sandbox' => 'array',
        'live' => 'array',
        'default' => 'boolean',
    ];
    public static $supportedPaymentCodes = ['khalti'];
    public static $khalti = 'khalti';

}
