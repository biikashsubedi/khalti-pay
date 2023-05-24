<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Success extends Model
{
    use HasFactory;

    protected $fillable = [
        'terminal',
        'pidx',
        'payment',
        'order',
        'name',
        'amount',
        'status',
        'detail',
    ];

    protected $casts = ['detail' => 'array'];
}
