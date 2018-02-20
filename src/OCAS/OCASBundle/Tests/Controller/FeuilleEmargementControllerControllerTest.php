<?php

namespace OCAS\OCASBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeuilleEmargementControllerControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/feuilles');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

}
