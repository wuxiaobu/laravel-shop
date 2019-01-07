<?php

namespace Wuxiaobu\Hasher;

use Illuminate\Support\ServiceProvider;
use Wuxiaobu\Hasher\Md5Hasher;

class Md5HasherProvider extends ServiceProvider
{   
    /**
     *标记服务提供者是否延迟加载
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('md5hash', function(){
            return new Md5Hasher();
        });
    }

    public function provides()
    {
        return ['md5hash'];
    }
}
