<?php

namespace Tests;

use Mockery;

class UserTest extends TestCase
{
    protected $user;

    protected function getTestUser()
    {
        $this->user = $this->obr->users()->find(1)['user'];
    }

    public function testNewUserCanBeCreated()
    {
        $user = [
            'name' => 'Testing User',
            'email_address' => 'test+' . time() . '@example.com',
            'password' => 'test123'
        ];

        $response = $this->obr->users()->store($user);

        $this->assertGreaterThan(1, $response['user']['id']);
    }

    public function testCanRetrieveUserById()
    {
        $this->getTestUser();

        $this->assertEquals($this->user['id'], 1);
    }
}
