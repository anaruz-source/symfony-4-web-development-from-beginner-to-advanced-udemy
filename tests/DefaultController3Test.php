<?php

namespace App\Tests;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultController3Test extends WebTestCase
{
    private $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->manager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->manager->beginTransaction();
        $this->manager->getConnection()->setAutoCommit(false);
    }

    protected function tearDown(): void
    {
        $this->manager->rollback();
        $this->manager->close();
        $this->manager = null;
    }

    public function testSomething(): void
    {
        $crawler = $this->client->request('GET', '/index');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');

        $repo = $this->manager->getRepository(Video::class);
        $video = $repo->find(1);
        $this->manager->remove($video);

        $this->manager->flush();

        $this->assertNull($repo->find(1));
    }
}
