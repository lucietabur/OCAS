<?php

namespace OCAS\OCASBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IntervenantControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/intervenant');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/intervenant/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/intervenant/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/intervenant/delete');
    }
}
