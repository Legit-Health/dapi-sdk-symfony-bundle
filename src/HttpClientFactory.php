<?php

namespace LegitHealth\DapiBundle;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClientFactory
{

    public static function withConfig(string $baseUri, string $analyzerApiKey): HttpClientInterface
    {
        return HttpClient::createForBaseUri($baseUri, [
            'headers' => [
                'x-api-key' => $analyzerApiKey
            ]
        ]);
    }
}
