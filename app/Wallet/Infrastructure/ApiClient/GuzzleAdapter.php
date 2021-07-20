<?php


namespace App\Wallet\Infrastructure\ApiClient;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements ApiClient
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }


    /**
     * @param string $url
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function get(string $url): ResponseInterface
    {
        return $this->client->get($url);
    }
}
