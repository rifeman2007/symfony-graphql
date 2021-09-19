<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker      = \Faker\Factory::create();
        
        $user       = new User();
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $manager->persist($user);
 
        for ($i=0; $i<5; $i++) {
            $user       = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
