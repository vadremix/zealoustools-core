<?php

namespace App\Classes;

use Illuminate\Cache\Repository as CacheRepository;

class CoinDataService
{
    protected $cacheRepository;

    public function __construct(CacheRepository $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    public function createProvider(string $provider)
    {
        $providerClass = 'App\Classes\CoinDataAdapters\\' . $provider . 'Adapter';

        return new $providerClass($this->cacheRepository);
    }
}