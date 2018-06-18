<?php

namespace RethinkGroup\SDK\Resources;

class Organization extends Resource
{
    public $entityName = 'organizations';

    public $singularEntityName = 'organization';

    /**
     * {@inheritdoc}
     */
    public function search(string $term, string $searchFields = null, bool $disableEagerLoading = false)
    {
        $params = [];
        $params['search'] = trim($term);

        if ( ! is_null($searchFields) ) {
            $params['searchFields'] = $searchFields;
        }

        $params['noEagerLoads'] = $disableEagerLoading;

        return  $this->client->get($this->entityName, $params)['data'][$this->entityName];
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

        return $this->client->post("{$this->entityName}/$id/addresses", $data)['data'];
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
           ->delete("{$this->entityName}/$organizationId/addresses/$addressId")['status'];
    }

    /**
     * Retrieve the list of users associated with the specified organization.
     *
     * @param  int    $id Primary key for the OBR organization.
     * @return array
     */
    public function getUsers(int $id)
    {
        return $this->client->get("{$this->entityName}/$id/users")['data']['users'];
    }

    /**
     * Create and add a user to an organization
     *
     * @todo Add already created users to organizations
     * @param int   $id   Primary key of the organization
     * @param array $user The user's information as an array
     */
    public function addUser(int $id, array $user)
    {
        return $this->client->post("{$this->entityName}/$id/users", $user)['data'];
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

    /**
     * Retrieve a list of organizations by the updated_at column
     * @param  string $date The YYYY-MM-DD timestamp to search by
     * @return array
     */
    public function getByUpdatedAt(string $date)
    {
        return $this->search($date, 'updated_at:>=', true);
    }

    /**
     * Retrieve the organization's access control records
     * @param  int    $id Primary key of the organization
     * @return array
     */
    public function getAccess(int $id)
    {
        return $this->client->get("{$this->entityName}/$id/accessControls")['data']['accessControls'];
    }
}
