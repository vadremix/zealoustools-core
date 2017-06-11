<?php

namespace App\Providers;

use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Support\ServiceProvider;

class CoinDataServiceProvider extends ServiceProvider
{

    protected $cacheRepository;

    public function boot(CacheRepository $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CoinDataService', function ($app) {
            return new App\Classes\CoinDataService($this->cacheRepository);
        });
    }
}
