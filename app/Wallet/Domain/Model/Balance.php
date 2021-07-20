<?php

namespace App\Wallet\Domain\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'wallet_balances';

    protected $fillable = ['wallet_id', 'balance'];

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'wallet_id', 'id');
    }
}
