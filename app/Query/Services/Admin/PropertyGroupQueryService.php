<?php
namespace App\Query\Services\Admin;

use App\Models\AdminPropertyGroup;

class PropertyGroupQueryService
{
    public function all(array $options = [])
    {
        return $this->query($options)->get();
    }

    public function query(array $options = [])
    {
        $query = AdminPropertyGroup::query();
        if (isset($options['group_id'])) {
            $query->where('id', $options['group_id']);
        }
        return $query;
    }
}
