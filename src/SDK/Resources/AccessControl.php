<?php

namespace RethinkGroup\SDK\Resources;

class AccessControl extends Resource
{
    protected $entityName = 'accessControls';

    protected $singularEntityName = 'accessControl';

    /**
     * Search for a SOUR record.
     *
     * @param  array  $fields organization_id, user_id, sku_id
     * @return array
     */
    public function accessControlSearch($fields = [])
    {
        $terms = '';
        $searchFields = '';

        $i = 0;
        foreach ($fields as $key => $value) {
            $terms .= ($i > 0) ? 'and|' : '';
            $terms .= "$key:$value;";

            $searchFields .= "$key:=;";

            $i++;
        }

        $result = $this->search($terms, $searchFields);

        return !empty($result) ? $result[0] : [];
    }
}
