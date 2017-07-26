<?php

namespace App\Classes\CoinDataAdapters;

class DummyAdapter extends CoinDataAdapterAbstract
{
    public function getPrice(string $coinCode)
    {
        return mt_rand(0, 3000);
    }

    protected function cacheLayer()
    {
        // fake implementation
    }

    protected function getData(bool $refreshCache = false)
    {
        // fake implementation
    }
}