<?php

namespace Tests;

class SkuTest extends TestCase
{
    protected $sku;

    protected function getTestSku()
    {
        $this->sku = $this->obr->skus()->find(1);
    }

    public function testCanRetrieveSkuById()
    {
        $this->getTestSku();
        $this->assertEquals($this->sku['id'], 1);
    }
}