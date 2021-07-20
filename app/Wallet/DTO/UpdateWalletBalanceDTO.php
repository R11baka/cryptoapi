<?php


namespace App\Wallet\DTO;


use App\Wallet\Domain\ValueObject\Network;

class UpdateWalletBalanceDTO extends AbstractDTO
{
    private int $walletId;
    private $balance;

    public function __construct(int $walletId, $balance)
    {
        $this->walletId = $walletId;
        $this->balance = $balance;
    }

    public function getWalletId(): int
    {
        return $this->walletId;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
