<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'detail' => 'array',
        'response' => 'array',
        'checkout_pass' => 'boolean',
        'initialize_pass' => 'boolean',
        'verification_pass' => 'boolean',
    ];

    public function processLogs($request, $checkout = false, $initialize = false, $verification = false, $payload = null, $status = false)
    {
        try {

            $getLog = TransactionLog::whereOrder($request['order'])->first();

            $response = [];
            if ($payload && $getLog) {
                $response = $getLog->response;
                $response[Carbon::now()->timestamp] = $payload;
            }

            if (empty($response) && !$initialize && !$verification) {
                $response[Carbon::now()->timestamp] = [
                    'orderPlaced' => [
                        'platform' => 'mobile',
                        'payload' => request()->all(),
                        'response' => $request,
                    ]
                ];
            }

            $data = [
                'order' => $request['order'],
                'name' => $request['name'],
                'email' => $request['email'],
                'number' => $request['number'],
                'payment' => 'Khalti',
                'status' => $status,
                'checkout_pass' => $checkout,
                'initialize_pass' => $initialize,
                'verification_pass' => $verification,
                'response' => $response,
            ];

            if ($getLog) {
                $getLog->update($data);
            } else {
                TransactionLog::create($data);
            }

        } catch (\Exception $e) {
            \Log::error('Unable to perform transaction logs ' . $e);
        }
    }


}
