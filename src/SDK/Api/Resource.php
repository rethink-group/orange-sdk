<?php

namespace RethinkGroup\SDK\Api;

use RethinkGroup\SDK\OrangeBusinessRules;
use RethinkGroup\SDK\Contracts\Resource as Contract;

abstract class Resource implements Contract
{
    public function __construct(OrangeBusinessRules $client)
    {
        $this->client = $client;
    }
}