<?php

namespace RethinkGroup\SDK\Resources;

class Address extends Resource
{
    protected $entityName = 'addresses';

    protected $singularEntityName = 'address';


    public function storeForOrganization(int $organizationId, array $data, bool $force = false)
    {
        if ($force) {
            $data['not_validated'] = true;
        }

        return $this->client->post("organizations/$organizationId/{$this->entityName}", $data)['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data, bool $force = false)
    {
        $method = (count($data) > 1) ? 'put' : 'patch';

        if ($force) {
            $data['not_validated'] = true;
        }

        if ($method == 'put') {
            return $this->client->put("{$this->entityName}/$id", $data)['data'][$this->singularEntityName];
        } else {
            return $this->client->patch("{$this->entityName}/$id", $data)['data'][$this->singularEntityName];
        }
    }

     /**
     * Retrieve a list of addresses by the updated_at column
     * @param  string $date The YYYY-MM-DD timestamp to search by
     * @return array
     */
    public function getByUpdatedAt(string $date)
    {
        return $this->search($date, 'updated_at:>=', true);
    }
}
