<?php

namespace RethinkGroup\SDK\Resources;

class Address extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        return $this->client->get("addresses/$id")['data'];
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
        if (count($data) > 1) {
            return $this->client->put("addresses/$id", $data)['data'];
        } else {
            return $this->client->patch("addresses/$id", $data)['data'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id)
    {
        //
    }
}
