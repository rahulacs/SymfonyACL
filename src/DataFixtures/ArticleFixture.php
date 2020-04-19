<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence(10));
            $article->setContent(implode($faker->paragraphs(3), ' '));
            $article->setUser($this->getReference('user' . ($i % 10)));
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
