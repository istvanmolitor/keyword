<?php

namespace Molitor\Keyword\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Molitor\Keyword\Console\Commands\DeleteAllKeywordsCommand;
use Molitor\Keyword\Repositories\KeywordRepository;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;

class KeywordServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'keyword');

        if ($this->app->runningInConsole()) {
            $this->commands([
                DeleteAllKeywordsCommand::class,
            ]);
        }

        $this->app->make(Router::class)
            ->group(['prefix' => 'api'], __DIR__ . '/../routes/api.php');
    }

    public function register(): void
    {
        $this->app->bind(KeywordRepositoryInterface::class, KeywordRepository::class);
    }
}
