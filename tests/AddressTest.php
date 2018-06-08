<?php

namespace Tests;

class AddressTest extends TestCase
{
    public function testCanUpdateAddress()
    {
        $data = [
            'line1'     =>  '123 Main St.',
            'line2'     =>  'Ste. 150',
            'city'      =>  'Cumming',
            'state'     =>  'GA',
            'zip'       =>  '30066',
            'country'   =>  'US',
            'latitude'  =>  '34.183513',
            'longitude' =>  '-84.219606',
            'not_validated' => true
        ];

        $address = $this->obr->addresses()->update(1, $data);
        
        $this->assertEquals($address['line1'], $data['line1']);
    }
}