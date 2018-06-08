<?php

namespace RethinkGroup\SDK\Resources;

class Sku extends Resource
{
    protected $entityName = 'skus';
    protected $singularEntityName = 'sku';

    public function getByKey($key)
    {
        return $this->search($key, 'key:like');
    }
}
