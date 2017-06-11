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
}