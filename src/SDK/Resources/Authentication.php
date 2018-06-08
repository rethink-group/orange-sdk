<?php

namespace RethinkGroup\SDK\Resources;

class Authentication extends Resource
{
    protected $entityName = 'authenticate';

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

        return $this->client->post($this->entityName, $data)['data'];
    }
}
