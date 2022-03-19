<?php

namespace App\libraries;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Steam
{
    private STATIC string $key = '278CFAA93F6CA30CC0B359A330CD9E79';
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     */
    public function checkSteamId($id): bool
    {
        $response = $this->client->request('GET',
            'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='. self::$key .'&steamids='.$id
        );
        $response = json_decode($response->getContent(), true);

        if ($response['response']['players'] == null )
            return false;
        else{
            return true;
        }
    }

}