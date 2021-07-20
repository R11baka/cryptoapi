<?php


namespace App\Wallet\Domain\Event;


class WalletWasCreated
{
    private int $walletId;

    public function __construct(int $id)
    {
        $this->walletId = $id;
    }

    /**
     * @return int
     */
    public function getWalletId(): int
    {
        return $this->walletId;
    }
}
