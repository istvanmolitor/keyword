<?php

namespace Molitor\Keyword\Providers;

use Illuminate\Support\ServiceProvider;
use Molitor\Keyword\Models\KeywordText;
use Molitor\Keyword\Observers\KeywordTextObserver;
use Molitor\Keyword\Repositories\KeywordRepository;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;

class KeywordServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        KeywordText::observe(KeywordTextObserver::class);
    }

    public function register()
    {
        $this->app->bind(
            KeywordRepositoryInterface::class,
            KeywordRepository::class
        );
    }
}
