<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');

        $link = $crawler->filter('a:contains("awesome link")')
                        ->link(); // click link to click during functional test

        $crawler = $client->click($link); // click the link

        //dump($crawler->filter('label:contains("Remember me")')->text());

        $this->assertSelectorTextContains('label:contains("Remember me")', 'Remember me'); // assert result

        // form submit test

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'admin@mail.com';
        $form['password'] = 'passw';
        $client->enableProfiler(); // Profiler enabled for only this test!

        $crawler = $client->submit($form);
        dump($client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect(); // if successfully logged in, redirect to the home page as done in browser!

        $this->assertEquals(1, $crawler->filter('a:contains("Logout")')->count());
    }
}
