<?php

namespace App\Tests\Controller;



use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }


    public function testIfUserCanGoToAccount(){
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@user.com');

        // simulate $testUser being logged in
        $this->client->loginUser($testUser);

        // test e.g. the profile page
        $this->client->request('GET', '/account');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur votre compte');
    }
    public function testIfAnonymousCantGoToAccount(){

        // test e.g. the profile page
        $this->client->request('GET', '/account');
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Connexion :');
    }


}
