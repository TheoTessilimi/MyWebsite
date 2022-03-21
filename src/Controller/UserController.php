<?php

namespace App\Controller;

use App\Entity\User;
use App\libraries\Steam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(EntityManagerInterface $entityManager, Steam $steam): Response
    {

        $users = $steam->getPlayerFriendList($this->getUser()->getSteamID());
        $response = [];
        $i = 0;
        foreach ($users as $user){
            $response[$i]['steam'] = $steam->getPlayerInfoWithId($user['steamid']);
            $response[$i]['friendinfo'] = $user;
            $i++;
        }


        return $this->render('user/index.html.twig', [
            'users' => $response,
        ]);
    }

    #[Route('/user/{steamid}', name: 'app_user_details')]
    public function user(EntityManagerInterface $entityManager, Steam $steam, $steamid): Response
    {
        $response = $steam->GetUserStatsForGame($steamid, '730');


        return $this->render('user/user.html.twig', [
            'users' => $response,
        ]);
    }
}
