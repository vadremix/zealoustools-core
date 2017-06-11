<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinDataCodes extends Model
{
    protected $hidden = ['id', 'coin_data_name_id', 'coin_data_provider_id'];
    protected $appends = ['name', 'provider'];

    public function nameRelation()
    {
        return $this->belongsTo('App\Models\CoinDataNames', 'coin_data_name_id');
    }

    public function providerRelation()
    {
        return $this->belongsTo('App\Models\CoinDataProviders', 'coin_data_provider_id');
    }

    public function getNameAttribute()
    {
        return $this->nameRelation()->first()->name;
    }

    public function getProviderAttribute()
    {
        return $this->providerRelation()->first()->name;
    }
}
