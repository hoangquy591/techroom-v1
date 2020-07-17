<?php

namespace App\Providers;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserRepositoryImp;
use App\Services\User\UserServiceImp;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserRepositoryInterface::class => UserRepositoryImp::class,
        UserServiceInterface::class => UserServiceImp::class
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(UserRepositoryInterface::class, UserRepositoryImp::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
