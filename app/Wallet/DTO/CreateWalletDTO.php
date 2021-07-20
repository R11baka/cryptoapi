<?php


namespace App\Wallet\DTO;

use App\Wallet\Domain\Model\NetworkType;
use Assert\Assertion;

class CreateWalletDTO extends AbstractDTO
{
    private string $address;
    private int $userId;
    private string $network;

    public function __construct(int $userId, string $address, string $network)
    {
        Assertion::integer($userId, 'UserId not integer');
        Assertion::notEmpty($address, 'Address is empty');
        Assertion::notEmpty($network, 'NetworkType is empty');
        $this->userId = $userId;
        $this->address = $address;
        $this->network = NetworkType::getTypeByName($network)->id;
    }


    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

}
