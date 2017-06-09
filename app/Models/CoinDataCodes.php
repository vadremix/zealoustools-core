<?php

namespace App\Models;

use App\Models\CoinDataNames as Name;
use App\Models\CoinDataProviders as Provider;

use Illuminate\Database\Eloquent\Model;

class CoinDataCodes extends Model
{
    public function name()
    {
        return $this->hasOne('Name');
    }

    public function provider()
    {
        return $this->hasOne('Provider');
    }
}
