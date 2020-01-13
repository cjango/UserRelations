<?php

namespace Jason\UserRelation;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    /**
     * 部署时加载
     * @Author:<C.Jason>
     * @Date:2018-06-22T16:01:20+0800
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('user_relation.php')]);
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

            $this->commands([
                Commands\InitRelations::class,
            ]);
        }
    }

    /**
     * 注册服务提供者
     * @Author:<C.Jason>
     * @Date:2018-06-22T16:01:12+0800
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'user_relation');
    }

}
