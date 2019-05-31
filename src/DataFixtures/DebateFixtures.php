<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Debate;
use App\Entity\User;

class DebateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Créer 10 débats fake
        for ($i = 0; $i < 100; $i++) {
            $author = new User;
            $author->setEmail($faker->email())
            ->setPseudo($faker->name())
            ->setPassword($faker->word());
            $manager->persist($author);
            $debate = new Debate();

            $debate->setAuthor($author->getUsername());
            $debate->setOwner($author);
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
