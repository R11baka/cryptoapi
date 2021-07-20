<?php

namespace App\Wallet\Domain\Model;

use App\Wallet\Domain\ValueObject\Network;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkType extends Model
{
    use HasFactory;

    protected $table = 'network_types';
    protected $fillable = ['name'];

    public static function getTypeByName($name)
    {
        return NetworkType::where('name', $name)->firstOrFail();
    }

    public function getNameById(int $id)
    {
        return NetworkType::where('id', $id)->firstOrFail();
    }

    public static function getNetworkById($id): Network
    {
        $network = NetworkType::where('id', $id)->firstOrFail();
        return new Network($network['name'], $id);
    }
}
