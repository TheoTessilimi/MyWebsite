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
        $users = $entityManager->getRepository(User::class)->findUsersWithSteamId();
        $response = [];
        $i = 0;
        foreach ($users as $user){
            $response[$i]['steam'] = $steam->getPlayerInfoWithId($user->getSteamID());
            $response[$i]['site'] = $user;
            $i++;
        }
        //dd($response);

        return $this->render('user/index.html.twig', [
            'users' => $response,
        ]);
    }
}
