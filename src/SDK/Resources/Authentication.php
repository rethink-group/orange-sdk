<?php

namespace RethinkGroup\SDK\Resources;

class Authentication extends AbstractResource
{
    /**
     * Authenticate a user's submitted credentials.
     * 
     * @param string $email The user's email address.
     * @param string $password The user's unencrypted password.
     * @return array The response message.
     */
    public function checkCredentials(string $email, string $password)
    {
        $data = [
            'email_address' => $email,
            'password' => $password
        ];

        return $this->client->post("authenticate", $data)['data'];
    }

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
