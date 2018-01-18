<?php

namespace RethinkGroup\SDK\Resources;

use RethinkGroup\SDK\OrangeBusinessRules;
use RethinkGroup\SDK\Contracts\Resource as Contract;

abstract class AbstractResource implements Contract
{
    protected $entityName;

    public function __construct(OrangeBusinessRules $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function search(string $term, string $searchFields = null)
    {
        $params = [];
        $params['search'] = trim($term);

        if ( ! is_null($searchFields) ) {
            $params['searchFields'] = $searchFields;
        }

        return  $this->client->get($this->entityName, $params)['data'][$this->entityName];
    }
}