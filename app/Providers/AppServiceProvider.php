<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        Passport::tokensCan([
            'admin' => 'Admin scope',
            'user' => 'User scope',
        ]);

        Passport::setDefaultScope([
            'user',
        ]);

        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        Request::macro('isAdmin', function () {
            return request()->segment(2) === 'admin';
        });

        $this->app->bind(AuthInterface::class, function ($app) {
            return Request::isAdmin() ? new AdminRepository() : new UserRepository();
        });
    }
}
