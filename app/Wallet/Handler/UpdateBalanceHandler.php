<?php


namespace App\Wallet\Handler;


use App\Wallet\Domain\Event\BalanceWasUpdated;
use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\DTO\UpdateWalletBalanceDTO;

class UpdateBalanceHandler
{
    private WalletRepository $repo;

    public function __construct(WalletRepository $walletRepo)
    {
        $this->repo = $walletRepo;
    }


    public function handle(UpdateWalletBalanceDTO $dto)
    {
        $wallet = $this->repo->updateBalance(
            $dto->getWalletId(),
            $dto->getBalance()
        );
        event(new BalanceWasUpdated($wallet->id));
        return $wallet;
    }

}
