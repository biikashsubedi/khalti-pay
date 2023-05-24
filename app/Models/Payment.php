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

    const SUCCESS = 'SUCCESS';
    const ERROR = 'ERROR';

    public static $supportedPaymentCodes = ['khalti'];
    public static $khalti = 'khalti';

    public function getPaymentConfig(): array
    {
        $mode = $this->mode ? "live" : "sandbox";
        return $this->$mode ?? [];
    }

    public function getPaymentMode(): string
    {
        return $this->mode ? "live" : "sandbox";
    }

    public function getPaymentType(): string
    {
        return ucfirst(strtolower(explode(" ", $this->code)[0]));
    }
}
