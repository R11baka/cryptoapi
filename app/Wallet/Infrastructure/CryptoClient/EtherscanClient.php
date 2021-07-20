<?php


namespace App\Wallet\Infrastructure\CryptoClient;

use App\Wallet\Domain\ValueObject\Network;
use App\Wallet\Infrastructure\ApiClient\ApiClient;

class EtherscanClient extends AbstractApiClient
{
    private ApiClient $client;
    private string $apiKey;
    const TEMPLATE_URL = 'https://api.etherscan.io/api?module=account&action=balance&address=%s&tag=latest&apikey=%s';

    public function __construct(ApiClient $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * https://api.etherscan.io/api?module=account&action=balance&address=0xddbd2b932c763ba5b1b7ae3b362eac3e8d40121a&tag=latest&apikey=YourApiKeyToken
     * @param string $address
     * @param Network $network
     * @return \Psr\Http\Message\ResponseInterface
     */
    function getBalance(string $address, Network $network)
    {
        $url = sprintf(self::TEMPLATE_URL, $address, $this->apiKey);
        $resp = $this->client->get($url);
        $response = $resp->getBody()->getContents();
        $responseResult = json_decode($response, true);
        if ($responseResult && $responseResult['status'] == 1) {
            return $responseResult['result'];
        }
        throw new \LogicException("Something wrong with result");
    }
}
