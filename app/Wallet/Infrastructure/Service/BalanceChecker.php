<?php


namespace App\Wallet\Infrastructure\Service;


use App\Wallet\Domain\Service\BalanceService;
use App\Wallet\Domain\ValueObject\Network;
use App\Wallet\Infrastructure\CryptoClient\CryptoClientFactory;

class BalanceChecker implements BalanceService
{
    private CryptoClientFactory $factory;

    public function __construct(CryptoClientFactory $factory)
    {
        $this->factory = $factory;
    }

    function getBalance(string $address, Network $network)
    {
        $apiClient = $this->factory->getCryptoClient($network->getName());
        return $apiClient->getBalance($address, $network);
    }
}
