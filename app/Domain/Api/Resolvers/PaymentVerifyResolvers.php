<?php

namespace App\Domain\Api\Resolvers;

use App\Models\Payment;

/**
 * Payment Verification Resolver helps to resolve the verification class of payment
 * To verify a new payment look at the example below and create a verify method in it.
 *
 *
 * PaymentNameTitle         ClassName           Location
 * Cash                     CashPayment         ApiController/{Version}/PaymentVerification/CashVerification
 * Khalti                   KhaltiPayment       ApiController/{Version}/PaymentVerification/KhaltiVerification
 * Esewa                    EsewaPayment         ApiController/{Version}/PaymentVerification/EsewaVerification
 * ConnectIps               ConnectIpsPayment    ApiController/{Version}/PaymentVerification/ConnectIpsVerification
 */
class PaymentVerifyResolvers
{
    // Base class namespace
    protected $namespace = 'App\Payment';

    public function __construct()
    {
    }

    /**
     * Fetches the version verification.
     *
     * @return string
     */
    protected function getVersionNamespace(): string
    {
        return ucfirst(strtolower($this->version));
    }

    /**
     * Resolve payments and payment class name.
     *
     * @param array|Collection $data Data to pass into view or process
     * @return void
     */
    public function resolve($success)
    {
        $namespaces = $this->namespace . '\\';
        $className = ucfirst(strtolower($success->payment)) . 'Verification';
        $classLocation = $namespaces . $className;
        $paymentClass = new $classLocation($success);
        return $paymentClass->verify();
    }
}
