<?php

namespace Functional;

use B2P\Client;
use PHPUnit\Framework\TestCase;

class AmountOrderTest extends TestCase {
	private Client $client;

	public function __construct(string $name) {
		parent ::__construct($name);
		$this->client = new Client(4051, 'test', true);
	}

	public function testAmount() {
		$cases = [
			[
				0 => 501315,
				1 => 5013.15
			],
			[
				0 => 501355,
				1 => 5013.55
			],
			[
				0 => 501388,
				1 => 5013.88
			],
			[
				0 => 501399,
				1 => 5013.99
			],
			[
				0 => 501301,
				1 => 5013.01
			],
			[
				0 => 501315,
				1 => '5013.15'
			],
			[
				0 => 501350,
				1 => 5013.5
			]
		];

		foreach($cases as $case) {
			$this->AssertSame($case[0], $this->client->centifyAmount($case[1]));
		}
	}

	public function testExceptionAmount() {
		$cases = [
			5013.9999,
			5013.999
		];

		$count = 0;

		foreach($cases as $case) {
			try {
				$this->client->centifyAmount($case);
			} catch(\Exception $e) {
				$this->AssertSame('Incorrect amount format - maximum two decimal places', $e->getMessage());

				$count++;
			}
		}

		$this->AssertSame(count($cases), $count);
	}
}