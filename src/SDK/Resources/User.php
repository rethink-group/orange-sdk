<?php

namespace RethinkGroup\SDK\Resources;

class User extends Resource
{
    public $entityName = 'users';

    public $singularEntityName = 'user';

    /**
     * Retrieve the user's access
     *
     * @param  int    $id The specified user's primary key
     * @return array
     */
    public function authorize(int $id)
    {
        return $this->client->post('authorize', ['user_id' => $id])['data']['authorizations'];
    }

    /**
     * Retrieve a user by searching for their email address
     *
     * @param  string|null $email
     * @return array
     */
    public function searchByEmail(string $email = null)
    {
        return $this->search($email, 'email_address:like');
    }
}
