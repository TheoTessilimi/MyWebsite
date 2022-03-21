<?php

namespace App\Controller;

use App\Entity\User;
use App\libraries\Steam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(EntityManagerInterface $entityManager, Steam $steam, Request $request): Response
    {
        //récupération des amis steam
        $i=0;
        foreach ($steam->getPlayerFriendList($this->getUser()->getSteamID()) as $friend){
            $friendsList[$i]['steamid'] = $friend['steamid'];
            $friendsList[$i]['friendSince'] = $friend['friend_since'];
            $i++;
        }

        //Nombre maximum d'éléments par page
        $limit = 10;
        //numéro de la page
        $page = (int)$request->query->get('page', 1);
        //
        $friendsListPaginate = $steam->getPaginatedFriendsList($page, $limit, $friendsList);

        //stocker steamid dans tableau



        //afficher que 10 users sur la page
        //pagination symfony


        return $this->render('user/index.html.twig', [
            'nbFriends' => count($friendsList),
            'users' => $friendsListPaginate,
            'itemLimits' => $limit,
            'actualPage' => $page
        ]);
    }

    #[Route('/user/{steamid}', name: 'app_user_details')]
    public function user(EntityManagerInterface $entityManager, Steam $steam, $steamid): Response
    {
        $response = $steam->GetUserStatsForGame($steamid, '730');
        $pseudo = $steam->getPseudoWithId($steamid);
        $avatar = $steam->getAvatarWithId($steamid);
        $userStats = [];
        if($response != null) {
            foreach ($response as $stats) {
                $userStats[$stats['name']] = (int)$stats['value'];

            }
        }

        return $this->render('user/user.html.twig', [
            'users' => $userStats,
            'pseudo' => $pseudo,
            'avatar' => $avatar
        ]);
    }
}
