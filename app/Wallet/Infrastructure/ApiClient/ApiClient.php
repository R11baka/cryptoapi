<?php


namespace App\Wallet\Infrastructure\ApiClient;


use Psr\Http\Message\ResponseInterface;

interface ApiClient
{
    function get(string $url): ResponseInterface;
}
