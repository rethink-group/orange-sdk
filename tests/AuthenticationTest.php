<?php

namespace Tests;

class AuthenticationTest extends TestCase
{
    /** 
     * Verify that valid credentials can be authenticated.
     * 
     * @return void
     */
    public function testCanAuthenticateCredentials()
    {
        $success = $this->obr->authentication()
            ->checkCredentials('test@rethinkgroup.org', 'secret');
        
        $this->assertGreaterThan(0, $success['user_id']);
    }

    /** 
     * Verify that invalid credentials are rejected.
     * 
     * @expectedException     \GuzzleHttp\Exception\ClientException
     */
    public function testCanRejectCredentials()
    {
        $this->obr->authentication()
            ->checkCredentials('test@rethinkgroup.org', 'wrong');   
    }
}