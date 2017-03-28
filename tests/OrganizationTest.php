<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use RethinkGroup\SDK\OrangeBusinessRules;

class OrganizationTest extends PHPUnit_Framework_TestCase
{
    public function testCanRetrieveOrganizationById()
    {
        $config = [
            'url' => 'http://orange_business_rules.dev/api/v1',
            'clientId' => 'TESTAPP',
            'clientSecret' => 'test123',
        ];

        $obr = new OrangeBusinessRules($config);
        $org = $obr->organizations()->find(1);
        
        $this->assertEquals($org['organization']['id'], 1);
    }
}