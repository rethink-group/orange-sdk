<?php

namespace RethinkGroup\SDK\Api;

class Organization extends Resource
{
    public function find($id)
    {
        return $this->client->get("organizations/$id");
    }
}