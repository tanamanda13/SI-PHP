<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Debate;

class DebateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Créer 10 débats fake
        for ($i = 0; $i < 10; $i++) {
            $debate = new Debate();

            $debate->setAuthor($faker->name());
            $debate->setCategory($faker->word());
            $debate->setTitle($faker->sentence(6, true));
            $debate->setDescription($faker->sentence());
            $debate->setSide1($faker->sentence());
            $debate->setSide2($faker->sentence());
            $debate->setcreated($faker->dateTimeBetween('-30 years', 'now', null));
            $debate->setSide1_votes($faker->numberBetween(1000, 9000));
            $debate->setSide2_votes($faker->numberBetween(1000, 9000));
            $debate->settotal_votes($debate->getSide1_votes()+$debate->getSide2_votes());
            $manager->persist($debate);
        }
        $manager->flush();
    }
}
