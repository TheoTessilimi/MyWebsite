<?php

namespace App\Tests\Controller;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Link;

class RegisterControllerTest extends WebTestCase
{


    /**
     * @var KernelBrowser
     */
    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }


    public function testRegisterPage(): void
    {
        $crawler = $this->client->request('GET', '/register');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    /** @noinspection CssInvalidPseudoSelector */
    public function testRegisterPageFromHome(): void
    {
        $crawler = $this->client->request('GET', '/');
        $link = $crawler->selectLink('Inscription')->link();
        $crawler = $this->client->click($link);

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Merci de vous inscrire pour continuer.")')->count());

        echo $this->client->getResponse()->getContent();

    }
}
