<?php

namespace App\Domain;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentModeDomain
{

    public function store($request)
    {
        return [
            'title' => ucwords(strtolower($request['title'])),
            'url' => $request['url'],
            'mode' => $request['mode'],
            'api_status' => $request['api_status'] ?? false,
            'web_status' => $request['web_status'] ?? false,
            'code' => strtolower($request['title']),
            'default' => $request['default'],
            'icon' => $request['icon'] ?? null,
        ];
    }


    public function config($request)
    {
        return [
            'live' => $request->live,
            'sandbox' => $request->sandbox,
            'id' => $request->pay_id
        ];
    }

}
