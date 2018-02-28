<?php

namespace OCAS\OCASBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormateurControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formateur');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formateur/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formateur/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/formateur/delete');
    }
}
