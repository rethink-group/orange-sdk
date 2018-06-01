<?php

namespace Tests;

class OrganizationTest extends TestCase
{
    protected $address;
    protected $organization;

    protected function getTestOrganization()
    {
        $this->organization = $this->obr->organizations()->find(1);
    }

    public function testCanRetrieveOrganizationById()
    {
        $this->getTestOrganization();
        
        $this->assertEquals($this->organization['id'], 1);
    }

    public function testCanStoreUnvalidatedAddress()
    {
        $data = [
            'line1'     =>  '123 Main St.',
            'line2'     =>  'Ste. 150',
            'city'      =>  'Cumming',
            'state'     =>  'GA',
            'zip'       =>  '30066',
            'country'   =>  'US',
            'latitude'  =>  '34.183513',
            'longitude' =>  '-84.219606'
        ];

        $address = $this->obr->organizations()->addAddress(1, $data, true);
        
        $this->assertNotEmpty($address['address']);
    }

    public function testCanDisassociateAddressFromOrganization()
    {
        $this->getTestOrganization();

        $organizationId = $this->organization['id'];
        
        $addressId = $this->organization['addresses'][0]['id'];

        $response = $this->obr->organizations()->disassociateAddress($organizationId, $addressId);
            
        $this->assertTrue($response);
    }

    public function testOrganizationNameCanBeUpdated()
    {
        $this->getTestOrganization();

        $updatedName = $this->organization['name'] . '!';

        $response = $this->obr->organizations()->update($this->organization['id'], ['name' => $updatedName]);

        $this->assertEquals($response['organization']['name'], $updatedName);

        // Reverse the change
        $correct = substr($updatedName, 0, strlen($updatedName) - 1);
        $this->obr->organizations()->update($this->organization['id'], ['name' => $correct]);
    }

    public function testOrganizationCanBeSearchedByName()
    {
        $this->getTestOrganization();

        $searchTerm = substr($this->organization['name'], 0, 5);

        $response = $this->obr->organizations()->searchByName($searchTerm);

        $this->assertEquals($response[0]['id'], $this->organization['id']);
    }

    public function testOrganizationCanOmniSearchedByName()
    {
        $this->getTestOrganization();

        $searchTerm = $this->organization['name'];

        $response = $this->obr->organizations()->omniSearch($searchTerm);

        $this->assertEquals($response[0]['id'], $this->organization['id']);
    }

    public function testOrganizationCanOmniSearchedByPhone()
    {
        $this->getTestOrganization();

        $searchTerm = $this->organization['phone_number'];

        $response = $this->obr->organizations()->omniSearch($searchTerm);

        $this->assertEquals($response[0]['id'], $this->organization['id']);
    }

    public function testListOfOrganizationsCanBeRetrieved()
    {
        $response = $this->obr->organizations()->get();
        $this->assertGreaterThan(0, count($response));
    }
}