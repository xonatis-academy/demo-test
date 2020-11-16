<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $book = new Book();
            $book->setTitle($faker->name);
            $book->setDescription($faker->text);
            $book->setPrice($faker->numberBetween(0, 50));
            $book->setImageFilename($faker->imageUrl());
            $manager->persist($book);
        }

        $manager->flush();
    }
}
