<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinDataCodes extends Model
{
    protected $hidden = ['id', 'coin_data_name_id', 'coin_data_provider_id'];
    protected $with = ['name', 'provider'];

    public function name()
    {
        return $this->belongsTo('App\Models\CoinDataNames', 'coin_data_name_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\CoinDataProviders', 'coin_data_provider_id');
    }
}
