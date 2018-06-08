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
        $email = 'test+' . time() . '@example.org';

        $this->obr->users()->store([
            'name' => 'Test User ' . time(),
            'email_address' => $email,
            'password' => 'test123'
        ]);

        $response = $this->obr->authentication()
            ->checkCredentials($email, 'test123');

        $this->assertGreaterThan(0, $response['user_id']);
    }

    /**
     * Verify that invalid credentials are rejected.
     *
     * @expectedException     \GuzzleHttp\Exception\ClientException
     */
    public function testCanRejectCredentials()
    {
        $this->obr->authentication()
            ->checkCredentials('test@example.org', 'wrong');
    }
}