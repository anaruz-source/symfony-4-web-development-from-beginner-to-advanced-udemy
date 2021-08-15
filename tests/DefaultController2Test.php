<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultController2Test extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testSomething($url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function provideUrls()
    {
        return [
            ['/login'],
            ['/index'],
        ];
    }
}
