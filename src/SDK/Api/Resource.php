<?php

namespace RethinkGroup\SDK\Api;

use RethinkGroup\SDK\OrangeBusinessRules;

abstract class Resource
{
    public function __construct(OrangeBusinessRules $client)
    {
        $this->client = $client;
    }
}