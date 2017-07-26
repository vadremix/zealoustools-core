<?php

namespace App\Http\Controllers;

use App\Classes\CoinDataService;
use App\Models\CoinDataCodes;
use App\Models\CoinDataProviders;
use Illuminate\Http\Request;

class CoinDataApiController extends Controller
{
    protected $request;
    protected $coinDataService;
    protected $coinDataCodes;

    public function __construct(Request $request, CoinDataService $coinDataService)
    {
        $this->request = $request;
        $this->coinDataService = $coinDataService;
        $this->coinDataCodes = new CoinDataCodes();
    }

    public function list()
    {
        $coinsList = $this->coinDataCodes->get()->all();

        return $coinsList;
    }

    public function getPrice(array $coinUids = [])
    {
        if ($requestInput = $this->request->input('coins')) {
            foreach ($this->request->input('coins') as $uid) {
                array_push($coinUids, $uid);
            }
        }

        // fetch coins by posted uids (else fetch all)
        if (count($coinUids) > 0) {
            $coins = [];

            foreach ($coinUids as $coin) {
                $data = $this->coinDataCodes::where('uid', $coin)->get()->toArray();
                $data = $data[0]; // flatten array

                $coins[] = $data;
            }

        } else {
            $data = $this->coinDataCodes->get()->toArray();

            $coins = $data;
        }

        // compile list of providers and sort coins into provider groups
        $providersList = [];
        $providerGroups = [];

        foreach ($coins as $coin) {
            $dataProvider = $coin['provider'];

            if (!in_array($dataProvider, $providersList)) {
                $providersList[] = $dataProvider;
            }

            if (!isset($providerGroups[$dataProvider])) {
                $providerGroups[$dataProvider] = [];
            }

            $providerGroups[$dataProvider][] = $coin;
        }

        // instantiate data provider adapters and get price data
        $coinsValued = [];

        foreach ($providersList as $provider) {
            $coinDataAdapter = $this->coinDataService->createProvider($provider);

            foreach ($providerGroups[$provider] as $coin) {
                $coin['price'] = $coinDataAdapter->getPrice($coin['code']);

                $coinsValued[] = $coin;
            }
        }

        return $coinsValued;
    }
}
