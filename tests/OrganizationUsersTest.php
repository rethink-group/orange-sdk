<?php

namespace Tests;

class OrganizationUsersTest extends TestCase
{
    protected $org;

    protected $address;

    public function setUp()
    {
        parent::setUp();

        $this->org = $this->obr->organizations()->store([
            'name' => 'Test User Org ' . time(),
            'phone_number' => '555-123-1234'
        ]);
    }

    protected function getTestOrganization()
    {
        $this->org = $this->obr->organizations()->find(1);
    }

    public function testOrganizationIdIsRequiredToGetUsers()
    {
        $this->expectException(\ArgumentCountError::class);

        $response = $this->obr->organizations()->getUsers();
    }

    public function testCanRetrieveOrganizationUsers()
    {
        $this->obr->organizations()->addUser($this->org['id'],
            [
            'name' => 'Testing User ' . time(),
            'email_address' => 'testingorg+' . time() . '@example.com',
        ]);

        $users = $this->obr->organizations()->getUsers($this->org['id']);

        $this->assertNotEmpty($users);
    }
}