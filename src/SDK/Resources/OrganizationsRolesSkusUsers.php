<?php

namespace RethinkGroup\SDK\Resources;

class OrganizationsRolesSkusUsers extends AbstractResource
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
        return $this->client->post("organizationsRolesSkusUsers", $data)['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data, bool $force = false)
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
