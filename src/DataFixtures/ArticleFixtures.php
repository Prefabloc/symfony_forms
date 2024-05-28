<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ( $i = 1 ; $i <= 20 ; $i ++ ) {
            $rand = random_int(0 , 3);
            $article = new Article();
            $article
                ->setLabel( "Article".$i )
                ->setReference("Rérérence".$i )
                ->setStock(1000 )
                ->setSociete($this->getReference('SOCIETE' . $rand ))
                ->setCanBeProduced(true);

            $manager->persist($article);
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            SocieteFixtures::class,
        ];
    }
}
