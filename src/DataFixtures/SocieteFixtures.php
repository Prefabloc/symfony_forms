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
            'BTP-VALROMEX',
            'EXFORMAN'
        ];

        foreach ($societes as $i => $label ) {
            $societe = (new Societe())->setLabel($label);
            $manager->persist($societe);

            //Ajout d'une référence pour chaque société
            $this->addReference('SOCIETE' . $i , $societe );
        }

        $manager->flush();

    }
}
