<?php

namespace App\DataFixtures;

use App\Factory\TechnologyFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnologyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $technologies = json_decode(file_get_contents(__DIR__.'/data/Technology.json'), true);

        foreach ($technologies as $technology) {
            TechnologyFactory::createOne(['name' => $technology['name']]);
        }
    }
}
