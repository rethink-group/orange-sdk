<?php

namespace Tests;

class ChurchDenominationTest extends TestCase
{
    protected $churchDenomination;

    public function setUp()
    {
        parent::setUp();

    }
    
    public function testCanRetrieveDenominationById()
    {
        $denomination = $this->obr->churchDenominations()->find(1);

        $this->assertNotEmpty($denomination);
    }    

}