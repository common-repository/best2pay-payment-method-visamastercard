<?php

namespace Functional;

use B2P\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class GettingPaymentLinksTest extends TestCase
{
    private Client $client;
    private array $registration_data;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->client = new Client(6219, 'test', true, true);

        $this->registration_data = [
            'amount' => 12312300,
            'currency' => 643,
            'description' => 'test desc'
        ];
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_purchase(): void
    {
        $order = $this->client->register($this->registration_data);
        $link = $this->client->purchase(['id' => $order->id]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_purchaseSBP(): void
    {
        $order = $this->client->register($this->registration_data);
        $link = $this->client->purchaseSBP(['id' => $order->id]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_authorize(): void
    {
        $order = $this->client->register($this->registration_data);
        $link = $this->client->authorize(['id' => $order->id]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_plait_purchase(): void
    {
        $order = $this->client->register($this->registration_data);
        $shop_cart = 'W3sicXVhbnRpdHlHb29kcyI6MiwiZ29vZENvc3QiOjI5OTksIm5hbWUiOiLQn9C70LDRgtGM0LUgTWFkcmlkaWNhICjQtNC10LzQvikgKNC60YDQsNGB0L3Ri9C5LCA0MikifSx7InF1YW50aXR5R29vZHMiOjIsImdvb2RDb3N0IjozMjkwLCJuYW1lIjoi0J/Qu9Cw0YLRjNC1IFN1c2FubmEgKNC00LXQvNC+KSAo0LrRgNCw0YHQvdGL0LksIDQ4KSJ9LHsicXVhbnRpdHlHb29kcyI6MiwiZ29vZENvc3QiOjI4OTAsIm5hbWUiOiLQodCw0YDQsNGE0LDQvSBWaWN0b3JpYSAo0LTQtdC80L4pICjQsdC10LvRi9C5LCA0MikifSx7InF1YW50aXR5R29vZHMiOjEsImdvb2RDb3N0IjoyOTksIm5hbWUiOiLQlNC+0YHRgtCw0LLQutCwIn1d';
        $link = $this->client->purchaseWithInstallment(['id' => $order->id/*, 'shop_cart' => $shop_cart*/]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_plait_authorize(): void
    {
        $order = $this->client->register($this->registration_data);
        $shop_cart = 'W3sicXVhbnRpdHlHb29kcyI6MiwiZ29vZENvc3QiOjI5OTksIm5hbWUiOiLQn9C70LDRgtGM0LUgTWFkcmlkaWNhICjQtNC10LzQvikgKNC60YDQsNGB0L3Ri9C5LCA0MikifSx7InF1YW50aXR5R29vZHMiOjIsImdvb2RDb3N0IjozMjkwLCJuYW1lIjoi0J/Qu9Cw0YLRjNC1IFN1c2FubmEgKNC00LXQvNC+KSAo0LrRgNCw0YHQvdGL0LksIDQ4KSJ9LHsicXVhbnRpdHlHb29kcyI6MiwiZ29vZENvc3QiOjI4OTAsIm5hbWUiOiLQodCw0YDQsNGE0LDQvSBWaWN0b3JpYSAo0LTQtdC80L4pICjQsdC10LvRi9C5LCA0MikifSx7InF1YW50aXR5R29vZHMiOjEsImdvb2RDb3N0IjoyOTksIm5hbWUiOiLQlNC+0YHRgtCw0LLQutCwIn1d';
        $link = $this->client->authorizeWithInstallment(['id' => $order->id, 'shop_cart' => $shop_cart]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_podeli(): void
    {
        $order = $this->client->register($this->registration_data);
        $link = $this->client->podeliPWI(['id' => $order->id]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    public function test_loan(): void
    {
        $order = $this->client->register($this->registration_data);
        $link = $this->client->loan(['id' => $order->id, 'reference' => 123456]);
        if (!$link) throw new Exception('Failure!');
        $this->assertEquals('string', gettype($link));
    }
}
