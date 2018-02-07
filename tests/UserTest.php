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

    /**
     * @expectedException   GuzzleHttp\Exception\ClientException
     */
    public function testUserWithDuplicateEmailIsBlocked()
    {
        $user = [
            'name' => 'Testing User',
            'email_address' => 'test+' . time() . '@example.com',
            'password' => 'test123'
        ];

        // Create the user the first time
        $this->obr->users()->store($user);

        // Attempt to create the user again
        $response = $this->obr->users()->store($user);

        $this->assertEquals('Validation Errors', $response['message']);
    }

    public function testCanRetrieveUserById()
    {
        $this->getTestUser();

        $this->assertEquals($this->user['id'], 1);
    }
}
