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
}