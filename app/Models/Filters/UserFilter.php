<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function userId($userId)
    {
        return $this->where('UserId', $userId);
    }

    public function mobile($mobile)
    {
        return $this->where('Mobile', $mobile);
    }

    public function trueName($trueName)
    {
        return $this->whereLike('TrueName', $trueName);
    }

    public function isAudit($isAudit)
    {
        return $this->where('IsAudit', $isAudit);
    }

    public function group($group_id)
    {
        return $this->where('group_id', $group_id);
    }

    public function isActivateType($is_activate_type)
    {
        return $this->where('is_activate_type', $is_activate_type);
    }

    public function createdAt($createdAt)
    {
        return $this->where('createdtime', '>=', $createdAt);
    }

    public function endedAt($endedAt)
    {
        return $this->where('createdtime', '<=', $endedAt);
    }

    // 默认处理查询
    public function setup()
    {
        return $this->recent();
    }
}
