<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LoginControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }
    public function testLoginPage(): void
    {
        $this->client->request('GET', '/login');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h2', 'Connexion :');
    }

    public function testLoginPageFromHome(): void
    {
        $crawler = $this->client->request('GET', '/');
        $link = $crawler->selectLink('Connexion')->link();
        $this->client->click($link);

        $this->assertSame(200, $this->client->getResponse()->getStatusCode()); //verication du status code de la page d'erreur
        $this->assertSelectorTextContains('h2', 'Connexion :');
    }

    public function testSuccessfullyLogin() : void{
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = "test@user.com";
        $form['_password'] = "password_user";
        $this->client->submit($form);
        $this->assertSame(302, $this->client->getResponse()->getStatusCode()); //verification d'une bonne redirection
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur mon site !'); //verification de la page de la redirection
    }
    public function testFailureLogin() : void {
        $crawler = $this->client->request('GET', '/login'); //envoi de l'utilisateur sur la page
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = "failure@user.com";
        $form['_password'] = "password_user";
        $this->client->submit($form);
        $this->assertSame(302, $this->client->getResponse()->getStatusCode()); //verification d'une redirection
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h5', 'Identifiant ou mot de passe incorrect'); //verification du message d'erreur
    }
}
