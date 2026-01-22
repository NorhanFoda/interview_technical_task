<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\MySql\{
    UserRepository,
    RoleRepository,
    ProductRepository,
    OrderRepository,
    OrderItemRepository
};
use App\Repositories\Contracts\{
    UserContract,
    RoleContract,
    ProductContract,
    OrderContract,
    OrderItemContract
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
        $this->app->bind(OrderContract::class, OrderRepository::class);
        $this->app->bind(OrderItemContract::class, OrderItemRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
