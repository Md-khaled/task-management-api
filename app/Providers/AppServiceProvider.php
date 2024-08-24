<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Request::macro('isAdmin', function () {
            return request()->segment(2) === 'admin';
        });

        $this->app->bind(AuthInterface::class, function ($app) {
            return Request::isAdmin() ? new AdminRepository() : new UserRepository();
        });
    }
}
