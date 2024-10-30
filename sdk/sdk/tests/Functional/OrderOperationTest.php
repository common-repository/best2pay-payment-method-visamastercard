<?php

namespace Functional;

use B2P\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class OrderOperationTest extends TestCase {
	private Client $client;

	public function __construct(string $name) {
		parent ::__construct($name);
		$this->client = new Client(5236, 'test', true);
	}

	/**
	 * @throws GuzzleException
	 */
	public function testGetOperation() {
		$ct_order = $this->client->order(['id' => '7874931']);

		$operationId = 2387183;
		$operation = $ct_order->getOperation($operationId);

		$this->assertSame($operationId, $operation->id->getValue(), 'Incorrect operation ID');
	}
}