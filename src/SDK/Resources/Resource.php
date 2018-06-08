<?php

namespace RethinkGroup\SDK\Resources;

use RethinkGroup\SDK\OrangeBusinessRules;
use RethinkGroup\SDK\Contracts\Resource as Contract;

class Resource implements Contract
{
    protected $entityName;

    protected $singularEntityName;


    public function __construct(OrangeBusinessRules $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id)
    {
        return $this->client->delete("{$this->entityName}/$id");
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id, bool $withTrashed = false)
    {
        try {
            $parameters = $withTrashed ? ['macro' => 'withTrashed'] : [];

            return $this->client->get("{$this->entityName}/$id", $parameters)['data'][$this->singularEntityName];
        } catch (\RequestException $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(bool $withTrashed = false, bool $noEagerLoads = true)
    {
        try {
            $parameters = $withTrashed ? ['macro' => 'withTrashed'] : [];

            $parameters[] = ['noEagerLoads' => $noEagerLoads];

            return $this->client->get($this->entityName, $parameters)['data'][$this->entityName];
        } catch (\RequestException $e) {
            return false;
        }
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

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        try {
            return $this->client->post($this->entityName, $data)['data'];
        } catch (\RequestException $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data)
    {
        return $this->client->patch("{$this->entityName}/$id", $data)['data'][$this->singularEntityName];
    }
}