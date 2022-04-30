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
        $this->assertSelectorTextContains('h1', 'Connexion :');
    }

    public function testLoginPageFromHome(): void
    {
        $crawler = $this->client->request('GET', '/');
        $link = $crawler->selectLink('Connexion')->link();
        $this->client->click($link);

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Connexion :');
    }

    public function testSuccessfullyLogin(){
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = "test@user.com";
        $form['_password'] = "password_user";
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur mon site !');
    }
    public function testFailureLogin(){
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = "failure@user.com";
        $form['_password'] = "password_user";
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h5', 'Identifiant ou mot de passe incorrect');
    }
}
