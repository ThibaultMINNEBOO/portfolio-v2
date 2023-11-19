<?php

namespace App\DataFixtures;

use App\Factory\ProjectFactory;
use App\Factory\TechnologyFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        ProjectFactory::createMany(100, function () {
            return [
                'technologies' => TechnologyFactory::randomRange(0, 3),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            TechnologyFixtures::class,
        ];
    }
}
