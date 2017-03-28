<?php

namespace RethinkGroup\SDK\Api;

class Organization extends Resource
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        return $this->client->get("organizations/$id");
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id)
    {
        //
    }
}
