<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinDataNames extends Model
{
    public function codes()
    {
        return $this->hasMany('App\Models\CoinDataCodes', 'coin_data_name_id');
    }
}
