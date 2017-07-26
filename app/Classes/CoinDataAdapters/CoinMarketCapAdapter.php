<?php

namespace App\Classes\CoinDataAdapters;

use Illuminate\Cache\Repository as CacheRepository;
use GuzzleHttp;
use Mockery\Exception;

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
        $data = $this->getData();
        $price = $data[$coinCode]->price_usd;

        return $price;
    }

    public function cacheLayer()
    {
        // if cache is valid return true
        if ($this->cacheRepository->has(get_class())) { // dummy comparison
            return true;
        } else {
            return $this->getData(true);
        }
    }

    public function getData(bool $refreshCache = false)
    {
        if ($refreshCache == false) {
            if ($this->cacheLayer()) {
                return $this->cacheRepository->get(get_class());
            };
        } else {
            try {
                $response = $this->httpClient->get('https://api.coinmarketcap.com/v1/ticker/');
            } catch (Exception $e) {
                return false;
            }

            $rawCoins = json_decode($response->getBody()->getContents());

            foreach ($rawCoins as $coin) {
                $data[$coin->symbol] = $coin;
            }

            $this->cacheRepository->put(get_class(), $data, 5);

            return $data;
        }
    }
}