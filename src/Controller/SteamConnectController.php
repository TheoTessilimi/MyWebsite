<?php

namespace App\Controller;

use xPaw\Steam\SteamOpenID;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SteamConnectController extends AbstractController
{
    #[Route('/steam/connect', name: 'app_steam_connect')]
    public function index(){
        if (isset($_GET[ 'openid_claimed_id' ])) {
            $CommunityID = SteamOpenID::ValidateLogin('https://127.0.0.1:8000/steam/connect');
        
            if ($CommunityID === null) {
                dd($CommunityID);
            } 
            else {
                dd($CommunityID);
            }
        }
         else {
            // Show login form
        return $this->render('steam_connect/index.html.twig');

        }
    }
}
