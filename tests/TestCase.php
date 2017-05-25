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

    /**
     * @before
     */
    public function setupOBR()
    {
        if (!$this->obr) {
            $this->obr = new OrangeBusinessRules($config);
        }
    }

    public function testOBRCanBeInstantiated()
    {
        $this->assertNotNull($this->obr);
    }
}
