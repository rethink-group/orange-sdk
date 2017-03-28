<?php

namespace Tests;

class OrganizationTest extends TestCase
{
    public function testCanRetrieveOrganizationById()
    {
        $org = $this->obr->organizations()->find(1);
        
        $this->assertEquals($org['organization']['id'], 1);
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
}