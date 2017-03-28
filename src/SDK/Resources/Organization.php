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

    /**
     * Create an address and associate with the specified organization.
     * 
     * @param int $id The organization's primary key.
     * @param array $data The address data.
     */
    public function addAddress(int $id, array $data)
    {
        return $this->client->post("organizations/$id/addresses", $data);
    }
}
