<?php

namespace App\DataFixtures;

use App\Entity\Usr;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 5; ++$i) {
            $user = new Usr();
            $user->setName('name-'.$i);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
