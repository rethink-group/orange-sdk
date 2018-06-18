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
}
