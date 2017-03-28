<?php

namespace Tests;

class OrganizationTest extends TestCase
{
    protected $address;
    protected $organization;

    protected function getTestOrganization()
    {
        $this->organization = $this->obr->organizations()->find(1)['organization'];
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
}