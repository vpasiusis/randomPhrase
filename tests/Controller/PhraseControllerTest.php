<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhraseControllerTest extends WebTestCase
{
     /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        yield ['/'];
        yield ['/save'];
        yield ['/search'];
       
    }

    public function testGeneratingPhrase()
    {
        $client = static::createClient();
        $crawler =   $client->request('GET', '/');

        $link = $crawler
                ->filter('#newPhrase')
                ->link();

        $crawler = $client->click($link);

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testSavingPhrase()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('savePhrase')->form();

        $crawler = $client->submit($form);
       
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function tesSearchPhrase()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('searchPhrase')->form();
        $form['url_code'] = '1325';
        $crawler = $client->submit($form);
       
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }


}
