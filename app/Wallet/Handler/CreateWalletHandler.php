<?php


namespace App\Wallet\Handler;

use App\Wallet\Domain\Handler\IHandler;
use App\Wallet\Domain\Model\Wallet;
use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\DTO\CreateWalletDTO;

class CreateWalletHandler implements IHandler
{
    private WalletRepository $walletRepository;

    public function __construct(WalletRepository $walletRepo)
    {
        $this->walletRepository = $walletRepo;
    }

    public function handle(CreateWalletDTO $dto): Wallet
    {
        return $this->walletRepository->addWallet(
            [
                'address' => $dto->getAddress(),
                'network_type' => $dto->getNetwork(),
                'user_id' => $dto->getUserId()
            ]
        );
    }

}
