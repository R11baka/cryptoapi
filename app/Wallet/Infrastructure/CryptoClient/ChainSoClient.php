<?php


namespace App\Wallet\Infrastructure\CryptoClient;

use App\Wallet\Domain\Service\BalanceService;
use App\Wallet\Domain\ValueObject\Network;
use App\Wallet\Infrastructure\ApiClient\ApiClient;


class ChainSoClient extends AbstractApiClient
{
    private ApiClient $client;
    const TEMPLATE_URL = 'https://chain.so/api/v2/get_address_balance/%s/%s';

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     *
     * https://chain.so/api/v2/get_address_balance/LTC/3PSAWxMoneJydvSJzUraY6HQcaN7gMVVdY
     * https://chain.so/address/BTC/bc1qenuugcv0490cgy489hpmmsz7k30m2vp3g3zrp6
     * @param string $address
     * @param Network $network
     */
    function getBalance(string $address, Network $network)
    {
        $url = sprintf(self::TEMPLATE_URL, $network->getName(), $address);
        $resp = $this->client->get($url);
        if ($resp->getStatusCode() !== 200) {
            throw new \LogicException("Incorrect fetch data from ChainSoClient");
        }
        $body = $resp->getBody()->getContents();
        if (empty($body)) {
            throw new \LogicException("Can't process body");
        }
        $result = json_decode($body, true);
        if ($result && $result['status'] === 'success' && !empty($result['data'])) {
            return $result['data']['confirmed_balance'];
        }
        throw new \LogicException("Incorrect response");
    }
}
