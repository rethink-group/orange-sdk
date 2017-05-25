<?php

namespace RethinkGroup\SDK\Resources;

class User extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        try {
            return $this->client->get("users/$id")['data'];
        } catch (\RequestException $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        try {
            return $this->client->post('users', $data)['data'];
        } catch (\RequestException $e) {
            return false;
        }
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
        try {
            return $this->client->delete("users/$id");
        } catch (\RequestException $e) {
            return false;
        }
    }
}
