<?php


namespace Database\Seeders;


use Illuminate\Support\Facades\DB;

class WalletSeeder
{
    public function run()
    {
        DB::table('wallets')->insert(
            [
                ['address' => '3PSAWxMoneJydvSJzUraY6HQcaN7gMVVdY','user_id'=>1,'network_type'=>1],
                ['address' => '0xde0b295669a9fd93d5f28d9ec85e40f4cb697bae','user_id'=>1,'network_type'=>3],
            ]
        );
    }

}
