<?php

namespace App\Http\Controllers\Api\Payment;

use App\Domain\PaymentModeDomain;
use App\Domain\Api\Resolvers\PaymentVerifyResolvers;
use App\Domain\Api\Resolvers\PaymentViewResolvers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentRequest;
use App\Http\Requests\Api\PaymentVerifyRequest;
use App\Models\Payment;
use App\Models\Success;
use App\Models\TransactionLog;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    use ResponseTrait;

    public function pay(PaymentRequest $request)
    {
        $requestData = (new PaymentModeDomain())->pay($request);
        $payment = Payment::whereCode($requestData['payment'])->firstOrFail();
        if (!$payment) {
            return $this->errorOccur('You lack the authority to use this payment method to make a payment.', 404);
        }
        $requestData['payment'] = $payment;

        (new TransactionLog())->processLogs($requestData, true);

        $response = (new PaymentViewResolvers($payment))->resolve($requestData);
        $res = \Config::get('constants.META');

        if (!$response) {
            $res['data'] = [
                'code' => Payment::ERROR
            ];
            return $res;
        }
        $res['data'] = [
            'code' => Payment::SUCCESS,
            'redirectUrl' => $response
        ];
        return $res;
    }

    public function success(Request $request)
    {
        $hasSuccess = Success::where('pidx', $request['pidx'])->first();
        if ($hasSuccess) {
            $payment = Payment::whereCode(strtolower($hasSuccess['payment']))->first();
            if ($payment) {
                $requestData = ['id' => $hasSuccess['order']];
                $payload = ['paymentSuccessResponse' => $request->all()];

                $transactionConfig = $payment->getPaymentConfig();

                (new TransactionLog())->processLogs($requestData, true, true, false, $payload);
                return redirect()->to($transactionConfig['mobileSuccessUrl'] . '&terminal=' . $hasSuccess['terminal']);
            }
        }
        $khaltiPay = Payment::whereCode(Payment::$khalti)->first();
        $config = $khaltiPay->getPaymentConfig();
        return redirect()->to($config['mobileFailedUrl']);
    }

    public function verify(PaymentVerifyRequest $request)
    {
        try {
            $success = Success::whereTerminal($request['terminal'])->firstOrFail();
            $response = ((new PaymentVerifyResolvers()))->resolve($success);

            $res = \Config::get('constants.META');
            if ($response) {
                $res['data'] = [
                    'code' => Payment::SUCCESS,
                    'message' => 'Payment Successfully Verified.'
                ];
                return $res;
            }
            $res['data'] = [
                'code' => Payment::ERROR,
                'message' => 'Unable to verify payment.'
            ];
            return $res;

        } catch (\Exception $e) {
            \Log::error('verify failed' . $e);
            return $this->errorOccur('Unable to verify payment.');
        }
    }
}
