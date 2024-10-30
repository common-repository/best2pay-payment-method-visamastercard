<?php

namespace Functional;

use B2P\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class OrderClassificationTest extends TestCase
{

    private Client $client;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->client = new Client(4051, 'test', true, false);
    }

    /**
     * @return void
     * @throws GuzzleException|Exception
     */
    public function testInstallment(): void
    {
        $client = new Client(4405, 'test', true, false);
        $order = $client->order(['id' => 7898268]);
        $this->assertSame('B2P\Models\Orders\InstallmentsOrder', get_class($order));
    }

    /**
     * @return void
     * @throws GuzzleException|Exception
     */
    public function testLoanFB(): void
    {
        $order_xml = file_get_contents('https://test.best2pay.net/webapi/info/Order?sector=5942&id=7662377&signature=NWRjZTk0YjQzMjFiYTRhMjBiMTVmYzljNmJjZDllZTQ=');
        $client = new Client(5942, 'test', true, false);
        $order = $client->handleResponse($order_xml);
        $order = $client->order(['id' => $order->id]);
        $this->assertSame('B2P\Models\Orders\LoanFBOrder', get_class($order));
    }

    /**
     * @return void
     * @throws GuzzleException|Exception
     */
    public function testLoanVDA(): void
    {
        $order_xml = file_get_contents('https://test.best2pay.net/webapi/info/Order?sector=6219&id=7920245&signature=OGQ0Y2M1N2RiMjM0NzgzNDJkZWY0MDJlZjdiNTMyNWVkY2FkNjY5YWI2NGQ3MTFjYTI2MzVjNTk2YzlkNmYxYg==');
        $client = new Client(6219, 'test', true, true);
        $order = $client->handleResponse($order_xml);
        $order = $client->order(['id' => $order->id]);
        $this->assertSame('B2P\Models\Orders\LoanVDAOrder', get_class($order));
    }

    /**
     * @return void
     * @throws GuzzleException|Exception
     */
    public function testCommonOrder(): void
    {
        $data = [
            'amount' => 12312300,
            'currency' => 643,
            'description' => 'test desc'
        ];
        $order = $this->client->register($data);
        $this->assertSame('B2P\Models\Orders\Order', get_class($order));
    }
}
