<?php

namespace Srmklive\PayPal\Tests\Unit\Client;

use GuzzleHttp\Utils;
use PHPUnit\Framework\TestCase;
use Srmklive\PayPal\Tests\MockClientClasses;
use Srmklive\PayPal\Tests\MockRequestPayloads;
use Srmklive\PayPal\Tests\MockResponsePayloads;

class OrdersTest extends TestCase
{
    use MockClientClasses;
    use MockRequestPayloads;
    use MockResponsePayloads;

    /** @test */
    public function it_can_create_an_order()
    {
        $expectedResponse = $this->mockCreateOrdersResponse();

        $expectedEndpoint = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $expectedParams = [
            'headers' => [
                'Accept'            => 'application/json',
                'Accept-Language'   => 'en_US',
                'Authorization'     => 'Bearer some-token',
            ],
            'json' => $this->createOrderParams(),
        ];

        $mockHttpClient = $this->mock_http_request($this->jsonEncodeFunction()($expectedResponse), $expectedEndpoint, $expectedParams, 'post');

        $this->assertEquals($expectedResponse, $this->jsonDecodeFunction()($mockHttpClient->post($expectedEndpoint, $expectedParams)->getBody(), true));
    }
}
