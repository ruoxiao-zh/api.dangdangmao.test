<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\UserWalletMoney;
use App\Observers\AdminUserObserver;
use App\Observers\UserWalletMoneyObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 设置 Carbon 语言
        \Carbon\Carbon::setLocale('zh');

        // 注册观察器
        // AdminUser::observe(AdminUserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });

        \API::error(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception) {
            throw  new  \Symfony\Component\HttpKernel\Exception\HttpException(404, '404 Not Found');
        });
    }
}
