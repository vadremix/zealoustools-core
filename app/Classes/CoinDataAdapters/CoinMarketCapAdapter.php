<?php

namespace App\Classes\CoinDataAdapters;

use Illuminate\Cache\Repository as CacheRepository;
use GuzzleHttp;

class CoinMarketCapAdapter extends CoinDataAdapterAbstract
{
    public $httpClient;

    public function __construct(CacheRepository $cacheRepository)
    {
        parent::__construct($cacheRepository);

        $this->httpClient = new GuzzleHttp\Client();
    }

    public function getPrice(String $coinCode)
    {
        // TODO: Implement getPrice() method.
    }

    public function cacheLayer()
    {
        // TODO: Implement cacheLayer() method.

        // if cache is valid return true
        if ('a' == 'b') { // dummy comparison
            return true;
        } else {
            $this->getData(true);
        }
    }

    public function getData(bool $refreshCache = false)
    {
        if ($refresh == false) {
            if ($this->cacheLayer()) {
                // return data from cache
            };
        } else {
            // retrieve data, set cache
        }
    }
}