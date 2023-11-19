<?php

namespace App\DataFixtures;

use App\Factory\TechnologyCategoryFactory;
use App\Factory\TechnologyFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TechnologyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $technologies = json_decode(file_get_contents(__DIR__.'/data/Technology.json'), true);

        foreach ($technologies as $technology) {
            TechnologyFactory::createOne(['name' => $technology['name'], 'categories' => TechnologyCategoryFactory::randomRange(0, 3)]);
        }
    }

    public function getDependencies(): array
    {
        return [
            TechnologyCategoryFixtures::class,
        ];
    }
}
