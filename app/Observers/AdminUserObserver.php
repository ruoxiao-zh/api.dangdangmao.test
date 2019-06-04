<?php

namespace App\Observers;

use App\Models\AdminUser;

class AdminUserObserver
{
    // 管理员登录成功, 记录登录次数, 登录 IP, 登录地点, 登录时间
    public function retrieved(AdminUser $adminUser)
    {
        $ipInfo = geoip(\request()->ip())->toArray();

        $adminUser->last_login_ip = $adminUser->current_login_ip;
        $adminUser->last_login_time = $adminUser->current_login_time;
        $adminUser->current_login_ip = $ipInfo['ip'];
        $adminUser->current_login_time = time();
        $adminUser->update_time = time();
        $adminUser->increment('login_count');

        $adminUser->save();
    }
}
