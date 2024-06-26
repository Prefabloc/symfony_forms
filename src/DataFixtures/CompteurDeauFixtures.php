<?php

namespace App\DataFixtures;

use App\Entity\CompteurDeau;
use App\Entity\Machine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompteurDeauFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        date_default_timezone_set('Indian/Reunion');

        for ($i = 1; $i <= 10; $i++) {
            $machine = new CompteurDeau();
            $machine
                ->setLabel('Compteur#' . $i);

            $manager->persist($machine);
        }

        $manager->flush();
    }
}
