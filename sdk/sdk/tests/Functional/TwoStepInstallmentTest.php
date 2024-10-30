<?php

namespace Functional;

use B2P\Client;
use PHPUnit\Framework\TestCase;

class TwoStepInstallmentTest extends TestCase
{

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->client = new Client(4385, 'test', true);
    }

    function test_completed()
    {
        $this->client->order(['id' => 8035947])->complete();
        $order_state = $this->client->order(['id' => 8035947])->getState();
        $this->assertSame('COMPLETED', $order_state);
    }

}
