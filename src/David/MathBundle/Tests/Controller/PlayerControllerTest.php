<?php

namespace David\MathBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Player/Create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Player/Delete');
    }

    public function testSetup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Player/Setup');
    }

}
