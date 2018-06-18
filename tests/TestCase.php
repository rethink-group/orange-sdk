<?php

namespace Tests;

use Mockery;
use PHPUnit_Framework_TestCase;
use RethinkGroup\SDK\OrangeBusinessRules;

class TestCase extends PHPUnit_Framework_TestCase
{
    public $obr;

    public function tearDown()
    {
        Mockery::close();
    }

    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/..');
        $dotenv->load();

        if (!$this->obr) {
            $this->obr = new OrangeBusinessRules([
                'url' => getenv('OBR_URL'),
                'clientId' => getenv('OBR_APP_ID'),
                'clientSecret' => getenv('OBR_SECRET')
                ]);
        }
    }

    public function testOBRCanBeInstantiated()
    {
        $this->assertNotNull($this->obr);
    }
}
