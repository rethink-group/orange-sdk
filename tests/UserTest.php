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
            'email_address' => 'test+' . rand(1,10000) . '@example.com',
            'password' => 'test123'
        ];

        $response = $this->obr->users()->store($user);

        $this->assertGreaterThan(0, $response['user']['id']);
    }

    /**
     * @expectedException   GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage   Validation Errors
     */
    public function testUserWithDuplicateEmailIsBlocked()
    {
        $user = [
            'name' => 'Testing User',
            'email_address' => 'test+' . rand(1,10000) . '@example.com',
            'password' => 'test123'
        ];

        // Create the user the first time
        $this->obr->users()->store($user);

        // Attempt to create the user again
        $this->obr->users()->store($user);
    }

    public function testUserCanBeFoundOrCreated()
    {
        $user = [
            'name' => 'Testing User',
            'email_address' => 'test+' . rand(1,10000) . '@example.com',
            'password' => 'test123'
        ];

        // Create the user the first time
        $this->obr->users()->store($user);

        // Attempt to create the user again
        $response = $this->obr->users()->createOrAuthenticate($user);

        $this->assertGreaterThan(0, $response['user_id']);
    }

    /**
     * @expectedException   GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage  Unauthorized
     */
    public function testExistingUserMustHaveCorrectCredentials()
    {
        $user = [
            'name' => 'Testing User',
            'email_address' => 'test+' . rand(1,10000) . '@example.com',
            'password' => 'test123'
        ];

        // Create the user the first time
        $this->obr->users()->store($user);

        // Attempt to create the user again, but with incorrect credentials.
        $user['password'] = 'wrong';
        $response = $this->obr->users()->createOrAuthenticate($user);
    }

    public function testCanRetrieveUserById()
    {
        $this->getTestUser();

        $this->assertEquals($this->user['id'], 1);
    }

    public function testCanRetrieveUserByEmail()
    {
        $this->getTestUser();

        $response = $this->obr->users()->findByEmail($this->user['email_address']);

        $this->assertEquals($this->user['id'], $response['users'][0]['id']);
    }
}
