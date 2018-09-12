<?php

namespace RethinkGroup\SDK\Resources;

class OrganizationsRolesSkusUsers extends Resource
{
    public $entityName = 'organizationsRolesSkusUsers';

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

    	return $this->search($terms, $searchFields)[0];
    }
}
