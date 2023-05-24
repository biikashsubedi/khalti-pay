<?php

namespace App\Payment;

use App\Models\Payment;
use App\Models\Success;
use App\Models\TransactionLog;
use App\Payment\Abstracts\BasePayment;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

/**
 *
 *
 * @package App\Payment
 */
class KhaltiPayment extends BasePayment
{
    public function process($data)
    {
        return $this->processKhalti($data);
    }

    private function processKhalti($data)
    {
        try {
            $payment = $data['payment'];
            $transactionConfig = $payment->getPaymentConfig();

            $bodyData = [
                "return_url" => $transactionConfig['systemReturnUrl'], //after success | redirected to this url
                "website_url" => $transactionConfig['mobileFailedUrl'], //if failed | return on this url
                "amount" => (int)$data['amount'] * 100,
                "purchase_order_id" => $data['id'],
                "purchase_order_name" => $data['name'],
            ];

            return self::processKhaltiApi($bodyData, $transactionConfig, $data);

        } catch (\Exception $e) {
            \Log::error('unable to perform khalti paymnent ' . $e);
        }

    }

    public function processKhaltiApi($bodyData, $transactionConfig, $requestData)
    {
        $response = Http::timeout(30)->withHeaders([
            'Authorization' => 'Key ' . $transactionConfig['secretKey']
        ])->post($transactionConfig['initiateUrl'], $bodyData);

        $data = json_decode((string)$response->getBody(), true);

        Success::create([
            'terminal' => Uuid::uuid4(),
            'pidx' => $data['pidx'],
            'payment' => Payment::$khalti,
            'order' => $requestData['id'],
            'name' => $requestData['name'],
            'amount' => $requestData['amount'],
        ]);

        $payload = [
            'initialize' => [
                'url' => $transactionConfig['initiateUrl'],
                'Authorization' => 'Key ' . $transactionConfig['secretKey'],
                'payload' => $bodyData,
                'response' => $data,
            ]
        ];
        (new TransactionLog())->processLogs($requestData, true, true, false, $payload);

        \Log::debug('Khalti response for order id ' . $bodyData['purchase_order_id'] . json_encode($data));

        if ($data && !empty($data['pidx']) && !empty($data['payment_url'])) {
            return $data['payment_url'];
        }

        return false;
    }
}
