<?php

namespace Molitor\Keyword\Providers;

use Illuminate\Support\ServiceProvider;

class KeywordServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        $this->app->bind(
            \Molitor\Keyword\Repositories\KeywordRepositoryInterface::class,
            \Molitor\Keyword\Repositories\KeywordRepository::class
        );
    }
}
