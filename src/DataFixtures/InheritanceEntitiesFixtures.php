<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $authors = ['Robert', 'Madline', 'Mariana'];

        foreach ($authors as $a) {
            $author = new Author();
            $author->setName($a);

            for ($i = 1; $i < 5; ++$i) {
                $p = new Pdf();
                $p->setFilename('file'.$i.'.pdf');
                $p->setSize($i * 1200);
                $p->setAuthor($author);
                $p->setDescription('PDF File n° '.$i);
                $p->setOrientation('Portrait');
                $p->setPagesNumber(12 * $i);
                $manager->persist($p);
            }

            for ($i = 1; $i < 4; ++$i) {
                $v = new Video();
                $v->setFilename('video'.$i.'.pdf');
                $v->setSize($i * 12000);
                $v->setAuthor($author);
                $v->setDescription('video File n° '.$i);
                $v->setFormat('mpeg-2');
                $v->setDuration(120 * $i);
                $manager->persist($v);
            }

            $manager->persist($author);
        }
        $manager->flush();
    }
}
