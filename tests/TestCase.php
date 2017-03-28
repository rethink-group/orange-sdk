<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use RethinkGroup\SDK\OrangeBusinessRules;

class TestCase extends PHPUnit_Framework_TestCase
{
    public $obr;

    /**
     * @before
     */
    public function setupOBR()
    {
        $config = [
            'url' => 'http://orange_business_rules.dev/api/v1',
            'clientId' => 'TESTAPP',
            'clientSecret' => 'test123',
        ];

        if (!$this->obr) {
            $this->obr = new OrangeBusinessRules($config);
        }
    }

    public function testOBRCanBeInstantiated()
    {
        $this->assertNotNull($this->obr);
    }
}