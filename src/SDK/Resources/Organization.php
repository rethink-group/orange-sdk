<?php

namespace RethinkGroup\SDK\Resources;

class Organization extends AbstractResource
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
