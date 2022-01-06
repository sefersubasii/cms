<?php

namespace Xgenious\Paymentgateway\Facades;

use Illuminate\Support\Facades\Facade;

class XgPaymentGateway extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'XgPaymentGateway';
    }
}
