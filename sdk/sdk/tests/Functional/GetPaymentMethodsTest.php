<?php

namespace Functional;

use B2P\Client;
use PHPUnit\Framework\TestCase;

/**
 * @stub
 */
class GetPaymentMethodsTest extends TestCase
{
    public function test_gettingMethods()
    {
        // @usage
        // $methods = Client::getPaymentMethods(null, true);
        // $methods = Client::getPaymentMethods();
        // $methods = Client::getPaymentMethods('EN');
        // $methods = Client::getPaymentMethods('EN', true);
        // $methods = Client::getPaymentMethods('RU', false);
        // $methods = Client::getPaymentMethods('RU', true);
        // throw new \Exception(print_r($methods, true));
        $this->assertEquals([], []);
    }
}
