<?php

namespace Tests;

class OrganizationUsersTest extends TestCase
{
    protected $address;
    protected $organization;

    protected function getTestOrganization()
    {
        $this->organization = $this->obr->organizations()->find(1)['organizations'][0];
    }

    public function testOrganizationIdIsRequiredToGetUsers()
    {
        $this->expectException(\ArgumentCountError::class);

        $response = $this->obr->organizations()->getUsers();
    }

    public function testCanRetrieveOrganizationUsers()
    {
        $this->getTestOrganization();

        $users = $this->obr->organizations()->getUsers($this->organization['id']);

        $this->assertNotEmpty($users);
    }
}