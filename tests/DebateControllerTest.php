<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DebateControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Please sign in', $crawler->filter('h1')->text());
    }
    public function testRegister()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Become a debater', $crawler->filter('h1')->text());
    }
    public function testRoot()
    {
        $client = static::createClient();

        // User not authorized to connect
        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }
}
