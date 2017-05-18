<?php

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var OpenIban\Client
     */
    private $client;

    /**
     * @before
     */
    public function setupClient()
    {
        $this->client = new OpenIban\Client();
    }

    public function testValidateSuccess1()
    {
        $actual = $this->client->validate('DE89370400440532013000');

        $this->assertArrayHasKey('valid', $actual);
        $this->assertTrue($actual['valid']);
    }

    public function testValidateSuccess2()
    {
        $actual = $this->client->validate('DE89370400440532013000', true);
        $this->assertArrayHasKey('checkResults', $actual);
        $this->assertArrayHasKey('bankCode', $actual['checkResults']);
        $this->assertTrue($actual['checkResults']['bankCode']);

    }

    public function testValidateSuccess3()
    {
        $actual = $this->client->validate('DE89370400440532013000', true, true);

        $this->assertArrayHasKey('bankData', $actual);
        $this->assertArrayHasKey('bankCode', $actual['bankData']);
        $this->assertArrayHasKey('name', $actual['bankData']);
        $this->assertArrayHasKey('zip', $actual['bankData']);
        $this->assertArrayHasKey('city', $actual['bankData']);
        $this->assertArrayHasKey('bic', $actual['bankData']);

        $this->assertEquals('37040044', $actual['bankData']['bankCode']);
        $this->assertEquals('Commerzbank', $actual['bankData']['name']);
        $this->assertEquals('50447', $actual['bankData']['zip']);
        $this->assertEquals('Köln', $actual['bankData']['city']);
        $this->assertEquals('COBADEFFXXX', $actual['bankData']['bic']);
    }

    public function testCalculate()
    {
        $actual = $this->client->calculate('DE', '37040044', '0532013000');

        $this->assertArrayHasKey('valid', $actual);
        $this->assertArrayHasKey('iban', $actual);
        $this->assertTrue($actual['valid']);
        $this->assertEquals('DE89370400440532013000', $actual['iban']);
    }
}
