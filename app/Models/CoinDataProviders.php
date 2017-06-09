<?php

namespace App\Models;

use App\Models\CoinDataCodes as Codes;

use Illuminate\Database\Eloquent\Model;

class CoinDataProviders extends Model
{
    public function codes()
    {
        return $this->hasMany('Codes');
    }
}
