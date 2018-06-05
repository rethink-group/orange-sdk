<?php

namespace RethinkGroup\SDK\Resources;

class Sku extends AbstractResource
{
    protected $entityName = 'skus';

    /**
     * {@inheritdoc}
     */
    public function find(int $id, bool $withTrashed = false)
    {
        $parameters = $withTrashed ? ['macro' => 'withTrashed'] : [];

        return $this->client->get("{$this->entityName}/$id", $parameters)['data']['sku'];
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

        return  $this->client->get('skus', $params)['data']['skus'];
    }

    public function getByKey($key)
    {
        return $this->search($key, 'key:like');
    }
}
