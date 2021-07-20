<?php


namespace App\Wallet\Infrastructure\CryptoClient;


use App\Wallet\Infrastructure\ApiClient\GuzzleAdapter;

class CryptoClientFactory
{
    public function getCryptoClient(string $networkName): AbstractApiClient
    {
        if (in_array($networkName, ['LTC', 'BTC'])) {
            return new ChainSoClient(new GuzzleAdapter());
        } elseif (
            $networkName === 'ETH'
        ) {
            $apiKey = (config('services.ETHERSCAN.api_key'));
            return new EtherscanClient(new GuzzleAdapter(), $apiKey);
        }
    }
}
