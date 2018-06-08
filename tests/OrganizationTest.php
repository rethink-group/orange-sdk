<?php

namespace Tests;

class OrganizationTest extends TestCase
{
    protected $org;

    protected $address;

    public function setUp()
    {
        parent::setUp();

        $this->org = $this->obr->organizations()->store([
            'name' => 'Test Org ' . time(),
            'phone_number' => '555-123-1234'
        ]);

        $this->addTestAddress();

        $this->org = $this->obr->organizations()->find($this->org['id']);
    }

    protected function addTestAddress()
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

        $this->obr->organizations()->addAddress($this->org['id'], $data, true);
    }

    public function testCanStoreUnvalidatedAddress()
    {
        $this->assertNotEmpty($this->org['addresses'][0]);
    }

    public function testCanDisassociateAddressFromOrganization()
    {
        $addressId = $this->org['addresses'][0]['id'];

        $response = $this->obr->organizations()->disassociateAddress($this->org['id'], $addressId);

        $this->assertTrue($response);
    }

    public function testOrganizationCanBeSearchedByName()
    {

        $name = 'TestOrg' . $this->org['id'];

        $this->obr->organizations()->update($this->org['id'], ['name' => $name]);

        $response = $this->obr->organizations()->searchByName($name);

        $this->assertEquals($response[0]['id'], $this->org['id']);
    }

    public function testOrganizationCanOmniSearchedByName()
    {

        $name = 'TestOrg' . $this->org['id'];

        $this->obr->organizations()->update($this->org['id'], ['name' => $name]);

        $response = $this->obr->organizations()->omniSearch($name);

        $this->assertEquals($response[0]['id'], $this->org['id']);
    }

    public function testOrganizationCanOmniSearchedByPhone()
    {
        $phone = microtime();

        $this->obr->organizations()->update($this->org['id'], ['phone_number' => $phone]);

        $response = $this->obr->organizations()->omniSearch($phone);

        $this->assertEquals($response[0]['id'], $this->org['id']);
    }

    public function testOrganizationsCanBeRetrievedByUpdated()
    {
        $response = $this->obr->organizations()->getByUpdatedAt('2018-06-01');
        $this->assertGreaterThan(0, count($response));
    }
}