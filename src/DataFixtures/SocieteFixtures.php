<?php

namespace App\DataFixtures;

use App\Entity\Societe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SocieteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $societe = (new Societe());
        $societe->setLabel('PREFABLOC');
        $manager->persist($societe);

        $societe = (new Societe());
        $societe->setLabel('PFB AGREGAT');
        $manager->persist($societe);

        $societe = (new Societe());
        $societe->setLabel('BTP VALROMEX');
        $manager->persist($societe);

        $societe = (new Societe());
        $societe->setLabel('PFB BETON');
        $manager->persist($societe);

        $societe = (new Societe());
        $societe->setLabel('EXFORMAN');
        $manager->persist($societe);

        $manager->flush();
    }
}
