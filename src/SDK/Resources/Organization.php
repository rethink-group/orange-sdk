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
     * @param bool $force Whether to check for address validation or not.
     */
    public function addAddress(int $id, array $data, bool $force = false)
    {
        if ($force) {
            $data['not_validated'] = true;
        }

        return $this->client->post("organizations/$id/addresses", $data);
    }
}
