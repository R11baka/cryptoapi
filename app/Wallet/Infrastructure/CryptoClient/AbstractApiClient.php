<?php


namespace App\Wallet\Infrastructure\CryptoClient;


use App\Wallet\Domain\ValueObject\Network;

abstract class AbstractApiClient
{
    abstract function getBalance(string $address, Network $network);
}
