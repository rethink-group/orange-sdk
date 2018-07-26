<?php

namespace Tests;

class UserTest extends TestCase
{
    protected $user;


    public function setUp()
    {
        parent::setUp();

        $this->user = $this->obr->users()->store([
            'name' => 'Test User ' . rand(1,1000),
            'password' => 'test123',
            'email_address' => 'testing+' . time().rand(1,1000) . '@rethinkgroup.org'
        ]);
    }

    public function testCanSearchForUserByEmail()
    {
        $firstUser = $this->obr->users()->searchByEmail('testing')[0];

        $this->assertNotNull($firstUser['email_address']);
    }

    public function testOmniSearchByEmailAddress()
    {
        $firstUser = $this->obr->users()->omniSearch('testing')[0];

        $this->assertNotNull($firstUser);
        $this->assertArrayHasKey('email_address', $firstUser);
    }

    public function testOmniSearchById()
    {
        $user = $this->obr->users()->omniSearch($this->user['id']);

        $this->assertNotNull($user);
    }
}