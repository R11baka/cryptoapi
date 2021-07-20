<?php


namespace App\Wallet\Application\Providers;


use App\Wallet\Domain\Repository\WalletRepository;
use App\Wallet\Infrastructure\Repository\WalletRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            WalletRepository::class,
            function ($app) {
                return new WalletRepositoryEloquent();
            }
        );
    }

}
