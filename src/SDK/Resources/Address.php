<?php

namespace RethinkGroup\SDK\Resources;

class Address extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        //
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
            return $this->client->put("addresses/$id", $data);
        } else {
            return $this->client->patch("addresses/$id", $data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id)
    {
        return $this->client->delete("addresses/$id");
    }
}
