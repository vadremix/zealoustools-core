<?php

use Illuminate\Database\Seeder;

class FakeCoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // initial coin name seeding
        $coins = [
            'Bitcoin' => 'BTC',
            'Litecoin' => 'LTC',
            'Etherium' => 'ETH',
            'Dogecoin' => 'DOGE',
            'Ripple' => 'XRP',
            'NEM' => 'XEM',
            'Etherium Classic' => 'ETC',
        ];

        // add the coin data provider
        DB::table('coin_data_providers')->insert([
            'name' => 'Dummy'
        ]);

        // put the coin names in db
        foreach ($coins as $coinName => $code) {
            DB::table('coin_data_names')->insert([
                'name' => $coinName
            ]);
        }

        // retrieve ids so we can add relationship
        $coinNamesIds = DB::table('coin_data_names')->get()->toArray();
        $coinNamesIds = array_combine($coins, $coinNamesIds);

        // generate unique ids for our coin codes
        $uids = [];

        foreach ($coinNamesIds as $code => $coin) {
            $unique = false;
            // in the unlikely event of a collision, try again
            while ($unique == false) {
                $uid = str_random(6);

                if (!in_array($uid, $uids)) {
                    $unique = true;
                }
            }

            array_push($uids, $uid);

            DB::table('coin_data_codes')->insert([
                'uid' => $uid,
                'code' => $code,
                'coin_data_name_id' => $coin->id,
                'coin_data_provider_id' => 1
            ]);
        }
    }
}
