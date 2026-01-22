<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\MySql\{
    UserRepository,
    RoleRepository,
    ProductRepository
};
use App\Repositories\Contracts\{
    UserContract,
    RoleContract,
    ProductContract
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);
        $this->app->bind(ProductContract::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
