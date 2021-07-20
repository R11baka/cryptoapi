<?php


namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

class NetworkTypeSeeder
{
    public function run()
    {
        DB::table('network_types')->insert(
            [
                ['name' => 'LTC'],
                ['name' => 'BTC'],
                ['name' => 'ETH'],
            ]
        );
    }
}
