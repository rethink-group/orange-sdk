<?php

namespace RethinkGroup\SDK\Resources;

class Organization extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        try {
            return $this->client->get("organizations/$id")['data'];
        } catch (\RequestException $e) {
            return false;
        }
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
        return $this->client->patch("organizations/$id", $data)['data'];
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
     * @return array The created address.
     */
    public function addAddress(int $id, array $data, bool $force = false)
    {
        if ($force) {
            $data['not_validated'] = true;
        }

        return $this->client->post("organizations/$id/addresses", $data)['data'];
    }

    /**
     * Disassociate with the specified organization.
     * 
     * @param int $organizationId   The organization's primary key.
     * @param int $addressId        The address's primary key.
     * @return bool Success of disassociation.
     */
    public function disassociateAddress(int $organizationId, int $addressId)
    {
        return (bool) $this->client
           ->delete("organizations/$organizationId/addresses/$addressId")['status'];
    }
}
