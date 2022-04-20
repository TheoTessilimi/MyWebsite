<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();


        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        echo $client->getResponse()->getContent();
    }

    /** @noinspection CssInvalidPseudoSelector */
    public function testHomePage(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(1, $crawler->filter('html:contains("Bienvenue sur mon site !")')->count());
    }
}
