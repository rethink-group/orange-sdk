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

    protected function storeUser(array $data)
    {
        $this->obr->users()->store($data);
    }

    protected function deleteUser(int $id)
    {
        $this->obr->users()->delete($id);
    }

    public function testCanRetrieveUserById()
    {
        $this->getTestUser();

        $this->assertEquals($this->user['id'], 1);
    }

    public function testCanUpdateUser()
    {
        $this->getTestUser();

        $password = 'test' . time();

        $response = $this->obr->users()->update($this->user['id'], ['password' => $password]);

        $this->assertNotEmpty($response);
    }
}
