<?php

namespace App\DataFixtures;

use App\Factory\TechnologyCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnologyCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = json_decode(file_get_contents(__DIR__.'/data/TechnologyCategory.json'), true);

        foreach ($categories as $category) {
            TechnologyCategoryFactory::createOne(['name' => $category['name']]);
        }
    }
}
