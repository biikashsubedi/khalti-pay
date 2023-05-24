<?php

namespace App\Domain\Api\Resolvers;

use App\Models\Payment;


class PaymentViewResolvers
{
    protected $baseViewPath = 'payment.';

    protected $paymentType;

    public function __construct(Payment $payment)
    {
        $this->setPaymentType($payment->getPaymentType());
    }

    public function setPaymentType($type)
    {
        $this->paymentType = strtolower($type);
        return $this;
    }

    public function setViewPath($path)
    {
        $this->baseViewPath = $path;
        return $this;
    }

    /**
     * Resolve payments.
     *
     * @param array|Collection $data Data to pass into view or process
     * @return void
     */
    public function resolve($data)
    {
        $className = '\\App\\Payment\\' . ucfirst(trim($this->paymentType)) . 'Payment';
        $paymentClass = new $className();
        return $paymentClass->setViewPath($this->baseViewPath)->setViewName($this->paymentType)->process($data);
    }
}
