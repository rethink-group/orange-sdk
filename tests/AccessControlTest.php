<?php

namespace Tests;

class AccessControlTest extends TestCase
{
    protected $org;

    protected $sku;

    public function setUp()
    {
        parent::setUp();

        $this->org = $this->obr->organizations()->store([
            'name' => 'Test Org ' . time(),
            'phone_number' => '555-123-4567'
        ]);

        $this->sku = $this->obr->skus()->store([
            'name' => 'Test Sku ' . time(),
            'meta' => 'Test Sku ' . time(),
            'key' =>  microtime() . '-DL'
        ]);
    }

    public function testOrganizationAccessCanBeRetrieved()
    {
        $this->obr->accessControl()->store([
            "sku_id" => $this->sku['id'],
            "organization_id" => $this->org['id'],
            "start_date" => "1997-01-01",
            "end_date" => "1997-02-01"
        ]);

        $response = $this->obr->organizations()->getAccess($this->org['id']);
        $this->assertGreaterThan(0, count($response));
    }
}