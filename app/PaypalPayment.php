<?php

namespace App;

class PaypalPayment implements PaymentInterface
{
    public function pay()
    {
        return 'pay with paypal';
    }
}