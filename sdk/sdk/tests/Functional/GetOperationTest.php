<?php

namespace Functional;

use B2P\Client;
use B2P\Responses\Operation;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class GetOperationTest extends TestCase
{
    private Client $client;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->client = new Client(5236, 'test', true);
    }

    /**
     * @throws GuzzleException
     */
    public function testOperation()
    {
        $result = $this->client->operation(['operation' => 2387183, 'id' => 7874931]);
        $this->assertEquals(true, is_a($result, Operation::class));
    }

    public function testRejectedOperation()
    {
        $client = new Client(4385, 'test', true);
        $result = $client->order(['id' => 7999042])->getOperation(2427457);
        // print_r($result->reason_code->msg());
        $this->assertEquals(true, is_a($result, Operation::class));
    }
}
