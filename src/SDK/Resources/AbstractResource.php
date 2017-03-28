<?php

namespace RethinkGroup\SDK\Resources;

use RethinkGroup\SDK\OrangeBusinessRules;
use RethinkGroup\SDK\Contracts\Resource as Contract;

abstract class AbstractResource implements Contract
{
    public function __construct(OrangeBusinessRules $client)
    {
        $this->client = $client;
    }
}