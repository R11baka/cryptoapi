<?php


namespace App\Wallet\Domain\ValueObject;


use Assert\Assertion;

class Network
{
    private string $name;
    private int $networkType;

    public function __construct(string $name, int $networkType)
    {
        Assertion::notBlank($name, "NetworkName should not be empty");
        $this->name = $name;
        $this->networkType = $networkType;
    }

    /**
     * @return int
     */
    public function getNetworkType(): int
    {
        return $this->networkType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
