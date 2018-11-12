<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SportControllerTest extends WebTestCase
{
    public function testShowall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'sport');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sport/create');
    }

}
