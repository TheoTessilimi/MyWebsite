<?php

namespace App\Controller;

use App\Form\SteamIdType;
use App\libraries\Steam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig',);
    }


    #[Route('/account/steamid', name: 'app_account_steamid')]
    public function steamid(Request $request, Steam $steam): Response
    {
        $notification = null;

        $form = $this->createForm(SteamIdType::class, $this->getUser());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $steamID = $form->get('steamID')->getData();
            if ($steam->checkSteamId($steamID)){

                $user = $form->getData();
                $user->setRoles(array('ROLE_USER_WITH_STEAMID'));
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = 'Votre id steam a bien été mis a jour !';
            }else{
                $notification = 'Id steam non valide !';
            }

        }



        return $this->render('account/steamid.html.twig',[
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
