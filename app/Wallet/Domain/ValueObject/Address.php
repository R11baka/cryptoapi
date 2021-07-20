<?php


namespace App\Wallet\Domain\ValueObject;

use Assert\Assertion;

class Address
{
    private string $address;

    public function __construct(string $address)
    {
        Assertion::notBlank($address, "Address can't be empty");
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }


}
