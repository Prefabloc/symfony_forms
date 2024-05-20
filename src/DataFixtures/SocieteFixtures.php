<?php

namespace App\DataFixtures;

use App\Entity\Societe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SocieteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $societes = [
            'PREFABLOC',
            'PREFABLOC AGREGATS',
            'BTP VALROMEX',
            'PREFABLOC BETON',
            'EXFORMAN'
        ];

        foreach ($societes as $label) {
            $societe = (new Societe())->setLabel($label);
            $manager->persist($societe);
        }

        $manager->flush();
    }
}
