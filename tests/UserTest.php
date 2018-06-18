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
            'email_address' => 'testing+' . rand(1,1000) . '@rethinkgroup.org'
        ]);
    }

    public function testCanSearchForUserByEmail()
    {
        $user = $this->obr->users()->searchByEmail('testing');

        $this->assertNotNull($user);
    }

    public function testOmniSearchByEmailAddress()
    {
        $user = $this->obr->users()->omniSearch('testing');

        $this->assertNotNull($user);
        $this->assertArrayHasKey('email_address', $user);
    }

    public function testOmniSearchById()
    {
        $user = $this->obr->users()->omniSearch($this->user['id']);

        $this->assertNotNull($user);
    }
}