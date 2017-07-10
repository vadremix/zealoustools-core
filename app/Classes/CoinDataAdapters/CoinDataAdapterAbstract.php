<?php

namespace App\Classes\CoinDataAdapters;

use App\Classes\CoinDataService;

abstract class CoinDataAdapterAbstract extends CoinDataService
{
    abstract protected function cacheLayer();
    abstract protected function getData(bool $refreshCache);

    // $coinCode example: BTC, LTC, etc
    abstract public function getPrice(string $coinCode);
}