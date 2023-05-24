<?php


namespace App\Payment;

use App\Models\Payment;
use App\Models\Success;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\Http;


class KhaltiVerification
{
    public function __construct(Success $success)
    {
        $this->success = $success;
        return $this;
    }

    public function verify()
    {
        try {
            $payment = Payment::whereCode($this->success->payment)->first();
            $bodyData = [
                "pidx" => $this->success->pidx
            ];

            $transactionConfig = $payment->getPaymentConfig();
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Key ' . $transactionConfig['secretKey']
            ])->post($transactionConfig['verifyUrl'], $bodyData);

            $data = json_decode((string)$response->getBody(), true);

            $payload = [
                'verification' => [
                    'url' => $transactionConfig['verifyUrl'],
                    'Authorization' => 'Key ' . $transactionConfig['secretKey'],
                    'payload' => $bodyData,
                    'response' => $data,
                ]
            ];

            $isSuccess = $response->status() == 200 && $data && !empty($data['status']) && $data['status'] == 'Completed';

            $requestData = ['id' => $this->success['order']];
            (new TransactionLog())->processLogs($requestData, true, true, true, $payload, $isSuccess);

            if ($isSuccess) {
                $this->success->update(['status' => true]);
                return true;
            }
            return false;

        } catch (\Exception $e) {
            \Log::error('khalti verification error' . $e);
        }
    }

}
