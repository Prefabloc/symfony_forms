<?php

namespace App\DataFixtures;

use App\Entity\TypeMateriau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeMateriauFixtures extends Fixture
{
    public function load ( ObjectManager $manager )
    {
        $types = [
            'MP Rocheux',
            'MP Terreux',
            'MP Mouillé',
            '20-50',
            'Autres'
        ];

        foreach ( $types as $type ){
            $typeMateriau = ( new TypeMateriau())->setType($type);
            $manager->persist($typeMateriau);
        }

        $manager->flush();
    }
}