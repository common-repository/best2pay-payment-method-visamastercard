<?php

namespace Functional;

use B2P\Client;
use B2P\Models\Orders\InstallmentsOrder;
use B2P\Models\Orders\LoanFBOrder;
use B2P\Models\Orders\LoanVDAOrder;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class OrderIsPaidTest extends TestCase
{
    /**
     * @return void
     * @throws GuzzleException
     */
    public function testInstallmentOrder(): void
    {
        $client = new Client(4405, 'test', true, false);
        $order = $client->order(['id' => 7898268]);

        $this->assertEquals(InstallmentsOrder::class, $order::class);
        $this->assertSame(true, $order->isPaid());
    }

    /**
     * @return void
     * @throws GuzzleException
     */
    public function testVDAOrder(): void
    {
        $client = new Client(6219, 'test', true, true);
        $order = $client->order(['id' => 7920245]);

        $this->assertEquals(LoanVDAOrder::class, $order::class);
        $this->assertSame(true, $order->isPaid());
    }

    /**
     * #[RunTestsInSeparateProcesses]
     * @return void
     * @throws GuzzleException
     */
    public function testFBOrder(): void
    {
        $client = new Client(5942, 'test', true, false);
        $order = $client->order(['id' => 7662377]);

        $this->assertEquals(LoanFBOrder::class, $order::class);
        $this->assertSame(true, $order->isPaid());
    }
}
