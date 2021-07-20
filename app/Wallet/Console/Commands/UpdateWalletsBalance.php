<?php

namespace App\Wallet\Console\Commands;

use App\Wallet\Domain\Model\NetworkType;
use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\Domain\ValueObject\Network;
use App\Wallet\DTO\UpdateWalletBalanceDTO;
use App\Wallet\Handler\UpdateBalanceHandler;
use App\Wallet\Infrastructure\Service\BalanceChecker;
use Illuminate\Console\Command;

class UpdateWalletsBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:updateBalance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update wallet balances';

    private WalletRepository $walletRepository;
    private UpdateBalanceHandler $handler;
    private BalanceChecker $balanceChecker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        WalletRepository $walletRepository,
        UpdateBalanceHandler $handler,
        BalanceChecker $balanceChecker
    ) {
        parent::__construct();
        $this->walletRepository = $walletRepository;
        $this->handler = $handler;
        $this->balanceChecker = $balanceChecker;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $wallets = $this->walletRepository->getAllWallets();
        foreach ($wallets as $wallet) {
            $this->info("Process wallet with id:" . $wallet->id);
            $this->processWallet($wallet);
        }
        return 0;
    }

    protected function processWallet($wallet)
    {
        try {
            $network = NetworkType::getNetworkById($wallet->network_type);
            $balance = $this->balanceChecker->getBalance($wallet->address, $network);
            $dto = new UpdateWalletBalanceDTO($wallet->id, $balance);
            $this->handler->handle($dto);
        } catch (\Exception $e) {
            \Log::error("Can't process wallet", ['message' => $e->getMessage(), 'wallet' => $wallet]);
            $this->error("Can't process wallet with id:" . $wallet->id . " " . $e->getMessage());
        }
    }


}
