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

    /**
     * Attempt to create the user, but if they exist, check their authentication.
     */
    public function createOrAuthenticate(array $data)
    {
        try {
            return $this->store($data);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // If we receive a "unique" exception, then attempt to authenticate them.
            return $this->client->authentication()
                ->checkCredentials($data['email_address'], $data['password']);
        }
    }

    /**
     * Retrieve the user by their email address.
     */
    public function findByEmail(string $email)
    {
        return $this->client->get("users", ['search' => "email_address:$email"])['data'];
    }
}
