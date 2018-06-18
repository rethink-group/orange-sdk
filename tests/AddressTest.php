<?php

namespace Tests;

class AddressTest extends TestCase
{
    protected $address;

    public function setUp()
    {
        parent::setUp();

        $this->address = $this->obr->addresses()->store([
            'line1'     =>  time() . ' Main St.',
            'line2'     =>  'Ste. 150',
            'city'      =>  'Cumming',
            'state'     =>  'GA',
            'zip'       =>  '30066',
            'country'   =>  'US',
            'latitude'  =>  '34.183513',
            'longitude' =>  '-84.219606',
            'not_validated' => true
        ]);
    }

    public function testCanUpdateAddress()
    {
        $data = [
            'line1'     =>  microtime() . ' Main St.',
            'line2'     =>  'Ste. 150',
            'city'      =>  'Cumming',
            'state'     =>  'GA',
            'zip'       =>  '30066',
            'country'   =>  'US',
            'latitude'  =>  '34.183513',
            'longitude' =>  '-84.219606',
            'not_validated' => true
        ];

        $address = $this->obr->addresses()->update($this->address['id'], $data);

        $this->assertEquals($address['line1'], $data['line1']);
    }
}