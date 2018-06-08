<?php

namespace Tests;

class SkuTest extends TestCase
{
    public function testCanRetrieveSkuByKey()
    {
        $key = 'TEST-' . time();

        $this->obr->skus()->store([
            'name' => 'Test Sku ' . time(),
            'meta' => 'Test Sku ' . time(),
            'key' => $key
        ]);

        $sku = $this->obr->skus()->getByKey($key);

        $this->assertNotEmpty($sku);
    }
}