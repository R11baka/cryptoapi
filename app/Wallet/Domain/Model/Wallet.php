<?php

namespace App\Wallet\Domain\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string address;
 * Class Wallet
 * @package App\Wallet\Domain\Model
 */
class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';
    protected $fillable = ['address', 'user_id', 'network_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balance()
    {
        return $this->hasMany(Balance::class, 'id', 'wallet_id');
    }

    public function lastBalance(){
            return $this->hasOne(Balance::class,'wallet_id','id')->latest();
    }
}
