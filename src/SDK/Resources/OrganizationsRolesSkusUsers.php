<?php

namespace RethinkGroup\SDK\Resources;

class OrganizationsRolesSkusUsers extends Resource
{
    public $entityName = 'organizationsRolesSkusUsers';

    public $singularEntityName = 'organizationRoleSkuUser';

    /**
     * Search for a SOUR record.
     *
     * @param  array  $fields organization_id, role_id, user_id, sku_id
     * @return array
     */
    public function sourSearch($fields = [])
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
