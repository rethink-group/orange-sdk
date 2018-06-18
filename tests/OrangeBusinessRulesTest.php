<?php

namespace Tests;

use RethinkGroup\SDK\OrangeBusinessRules;

class OrangeBusinessRulesTest extends TestCase
{
    public function testConstructorCanReceiveConfig()
    {
        $obr = new OrangeBusinessRules([
            'url' => getenv('OBR_URL'),
            'clientId' => getenv('OBR_APP_ID'),
            'clientSecret' => getenv('OBR_SECRET')
            ]);

        $this->assertNotNull($obr->getUrl());
        $this->assertNotNull($obr->getClientId());
        $this->assertNotNull($obr->getClientSecret());
    }

    public function testCanSetAndGetUrl()
    {
        $url = 'example.com';
        $this->obr->setUrl($url);
        $this->assertEquals($url, $this->obr->getUrl());
    }

    public function testCanSetAndGetClientId()
    {
        $clientId = 'APP' . time();
        $this->obr->setClientId($clientId);
        $this->assertEquals($clientId, $this->obr->getClientId());
    }

    public function testCanSetAndGetClientSecret()
    {
        $clientSecret = 'secret' . time();
        $this->obr->setClientSecret($clientSecret);
        $this->assertEquals($clientSecret, $this->obr->getClientSecret());
    }

    public function testCanGetHTTPClient()
    {
        $this->assertInstanceOf(\GuzzleHttp\Client::class, $this->obr->getHttpClient());
    }

    public function testHTTPClientIsSetIfEmpty()
    {
        $obr = new OrangeBusinessRules([]);

        $this->assertInstanceOf(\GuzzleHttp\Client::class, $obr->getHttpClient());
    }

    public function testHTTPClientCanBeSet()
    {
        $client = new \GuzzleHttp\Client;
        $client->testAttribute = 'testing';

        $this->obr->setHttpClient($client);

        $this->assertEquals($this->obr->getHttpClient()->testAttribute, 'testing');
    }

    public function testCanGetAndSetResources()
    {
        $this->obr->setResources(['testing']);
        $this->assertNotEmpty($this->obr->getResources());
    }
}