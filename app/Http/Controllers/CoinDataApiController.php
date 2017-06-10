<?php

namespace App\Http\Controllers;

use App\Models\CoinDataCodes;
use Illuminate\Http\Request;

class CoinDataApiController extends Controller
{
    public function list()
    {

        $coinDataCodes = new CoinDataCodes();

        $coinsList = $coinDataCodes->get()->all();

        return $coinsList;
    }
}
