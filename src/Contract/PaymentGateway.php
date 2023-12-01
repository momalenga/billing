<?php
namespace Shengamo\Billing\Contract;

interface PaymentGateway
{
    public function processPayment($amount, $plan, $currency, $mobile, $qty, $description);

    public function refundPayment($chargeId);

    public function getCharge($chargeId);

    public function verifyCharge($chargeId);

    public function createCustomer($email, $cardNumber, $cardExpMonth, $cardExpYear, $cardCvc, $mobile);

    public function updateCustomer($customerId, $cardNumber, $cardExpMonth, $cardExpYear, $cardCvc, $mobile);

    public function getCustomer($customerId);
}
