<?php

namespace App\Http\Controllers;

use App\Classes\CoinDataService;
use App\Models\CoinDataCodes;
use Illuminate\Http\Request;

class CoinDataApiController extends Controller
{
    protected $coinDataService;

    public function __construct(CoinDataService $coinDataService)
    {
        $this->coinDataService = $coinDataService;
    }

    public function list()
    {

        $coinDataCodes = new CoinDataCodes();

        $coinsList = $coinDataCodes->get()->all();

        return $coinsList;
    }
}
