<?php

namespace Functional;

use B2P\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class RegisterOrderTest extends TestCase
{

    private Client $client;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->client = new Client(4051, 'test', true);
    }

    /**
     * @throws GuzzleException
     */
    public function testRegisterOrder()
    {
        $data = [
            'amount' => 12312300,
            'currency' => 643,
            'description' => 'test desc',
            // 'url' => 'https://google.com'
        ];
        $result = $this->client->register($data);

        // print_r($result);

        $this->assertSame('B2P\Models\Orders\Order', get_class($result));
        $this->assertSame('test desc', (string)$result->description);
    }
}
