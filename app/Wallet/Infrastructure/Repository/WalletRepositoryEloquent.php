<?php


namespace App\Wallet\Infrastructure\Repository;

use App\Wallet\Domain\Event\WalletWasCreated;
use App\Wallet\Domain\Model\Balance;
use App\Wallet\Domain\Model\Wallet;
use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\Domain\ValueObject\Network;
use Assert\Assertion;

class WalletRepositoryEloquent implements WalletRepository
{

    /**
     * @param string $address
     * @param Network $network
     * @return Wallet
     */
    public function getByAddress(string $address, Network $network): Wallet
    {
        return Wallet::where('address', $address)->where('network_type', $network->getNetworkType());
    }

    /**
     * @param int $id
     * @return Wallet
     */
    public function getById(int $id): Wallet
    {
        return Wallet::with(['lastBalance'])->where('id', $id)->get();
    }

    /**
     * @param int $userId
     * @return Wallet[]
     */
    public function getByUserId(int $userId)
    {
        Assertion::integer($userId, 'userId must be number');
        return Wallet::with(['lastBalance'])->where('user_id', $userId)->get();
    }

    public function addWallet(array $data): Wallet
    {
        $wallet = Wallet::create($data);
        event(new WalletWasCreated($wallet->id));
        return $wallet;
    }

    /**
     * @param string $address
     * @param int $networkType
     * @param $balance
     * @return mixed|void
     */
    public function updateBalance(int $walletId, $balance)
    {
        return Balance::create(['wallet_id' => $walletId, 'balance' => $balance]);
    }

    public function getAllWallets()
    {
        return Wallet::all();
    }
}
