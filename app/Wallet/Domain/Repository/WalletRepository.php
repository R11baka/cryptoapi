<?php


namespace App\Wallet\Domain\Repository;


use App\Wallet\Domain\Model\Wallet;
use App\Wallet\Domain\ValueObject\Network;

interface WalletRepository
{
    /**
     * @param string $address
     * @param Network $network
     * @return Wallet
     */
    public function getByAddress(string $address, Network $network): Wallet;

    /**
     * @param int $id
     * @return Wallet
     */
    public function getById(int $id): Wallet;

    /**
     * @param int $userId
     * @return array<Wallet>
     */
    public function getByUserId(int $userId);

    /**
     * @param array $data
     * @return Wallet
     */
    public function addWallet(array $data): Wallet;


    /**
     * @param int $walletId
     * @param $balance
     * @return mixed
     */
    public function updateBalance(int $walletId, $balance);

    /**
     * @return array
     */
    public function getAllWallets();

}
