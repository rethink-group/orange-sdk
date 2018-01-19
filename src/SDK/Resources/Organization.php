<?php

namespace RethinkGroup\SDK\Resources;

class Organization extends AbstractResource
{
    protected $entityName = 'organizations';

    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        try {
            return $this->client->get($this->entityName, [$id])['data']['organizations'][0];
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
     * {@inheritdoc}
     */
    public function search(string $term, string $searchFields = null)
    {
        $params = [];
        $params['search'] = trim($term);

        if ( ! is_null($searchFields) ) {
            $params['searchFields'] = $searchFields;
        }

        return  $this->client->get('organizations', $params)['data']['organizations'];
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

    /**
     * Retrieve the list of users associated with the specified organization.
     *
     * @param  int    $id Primary key for the OBR organization.
     * @return array
     */
    public function getUsers(int $id)
    {
        return $this->client->get("organizations/$id/users")['data']['users'];
    }

    /**
     * Retrieve a list of organizations by name search.
     *
     * @param string $name  The name to search for.
     * @return array
     */
    public function searchByName(string $name)
    {
        return $this->search($name, 'name:like');
    }

    /**
     * Retrieve a list of organizations by multiple fields.
     *
     * @param string $name  The name to search for.
     * @return array
     */
    public function omniSearch(string $searchTerm)
    {
        return $this->search($searchTerm, 'name:like;phone_number:like');
    }
}
