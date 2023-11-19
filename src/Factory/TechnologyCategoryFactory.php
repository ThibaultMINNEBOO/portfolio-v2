<?php

namespace App\Factory;

use App\Entity\TechnologyCategory;
use App\Repository\TechnologyCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<TechnologyCategory>
 *
 * @method        TechnologyCategory|Proxy                     create(array|callable $attributes = [])
 * @method static TechnologyCategory|Proxy                     createOne(array $attributes = [])
 * @method static TechnologyCategory|Proxy                     find(object|array|mixed $criteria)
 * @method static TechnologyCategory|Proxy                     findOrCreate(array $attributes)
 * @method static TechnologyCategory|Proxy                     first(string $sortedField = 'id')
 * @method static TechnologyCategory|Proxy                     last(string $sortedField = 'id')
 * @method static TechnologyCategory|Proxy                     random(array $attributes = [])
 * @method static TechnologyCategory|Proxy                     randomOrCreate(array $attributes = [])
 * @method static TechnologyCategoryRepository|RepositoryProxy repository()
 * @method static TechnologyCategory[]|Proxy[]                 all()
 * @method static TechnologyCategory[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static TechnologyCategory[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static TechnologyCategory[]|Proxy[]                 findBy(array $attributes)
 * @method static TechnologyCategory[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static TechnologyCategory[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class TechnologyCategoryFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(TechnologyCategory $technologyCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TechnologyCategory::class;
    }
}
