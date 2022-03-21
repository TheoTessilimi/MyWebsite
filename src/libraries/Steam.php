<?php

namespace App\libraries;


use Symfony\Config\FrameworkConfig;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Steam
{
    private STATIC string $key = '278CFAA93F6CA30CC0B359A330CD9E79';
    private HttpClientInterface $client;
    private FrameworkConfig $framework;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    public function getPlayerSummaries($id){
        $response = $this->client->request('GET',
            'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='. self::$key .'&steamids='.$id
        );
        return json_decode($response->getContent(), true)['response'];

    }

    public function getPlayerFriendList($id){
            $response = $this->client->request('GET',
                'https://api.steampowered.com/ISteamUser/GetFriendList/v1?key=' . self::$key . '&steamid=' . $id,
            );
        return json_decode($response->getContent(), true)['friendslist']['friends'];

    }

    public function GetUserStatsForGame($id, $appid){
        $response = $this->client->request('GET',
            'https://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v2?key='. self::$key .'&steamid='. $id .'&appid='.$appid
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getContent(), true)['playerstats']['stats'];
        }
        else{
            return false;
        }

    }


    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     */
    public function checkSteamId($id): bool
    {
        if ($this->getPlayerSummaries($id)['players'] == null )
            return false;
        else{
            return true;
        }
    }

    public function getPseudoWithId($id){
        return $this->getPlayerSummaries($id)['players']['0']['personaname'];
    }

    public function getPlayerInfoWithId($id){
        return $this->getPlayerSummaries($id)['players']['0'];

    }

}