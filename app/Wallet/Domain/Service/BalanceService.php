<?php


namespace App\Wallet\Domain\Service;


use App\Wallet\Domain\ValueObject\Network;

interface BalanceService
{
    function getBalance(string $address, Network $network);
}
