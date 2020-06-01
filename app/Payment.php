<?php

namespace App;

class Payment implements PaymentInterface
{
    public function pay()
    {
        return 'pay with stripe';
    }
}