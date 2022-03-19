<?php

namespace App\Controller;

use App\libraries\Steam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Steam $steam, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();
            if ($user->getSteamId() != null) {
                $user->setPseudo($steam->getPseudoWithId($user->getSteamId()));
                $entityManager->flush();
            }
        }
        return $this->render('home/index.html.twig');
    }
}
