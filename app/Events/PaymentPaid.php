<?php

namespace Coyote\Events;

use Coyote\Payment;


class PaymentPaid
{
    

    /**
     * @var Payment
     */
    public $payment;

    /**
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
