<?php

namespace App\DataFixtures;

use App\Entity\Machine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MachineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        date_default_timezone_set('Indian/Reunion');

        for ($i = 1; $i <= 10; $i++) {
            $machine = new Machine();
            $machine
                ->setLabel('Machine#' . $i)
                ->setType(random_int(0, 1) === 0 ? 'engin' : 'vehicule');

            $manager->persist($machine);
        }

        $manager->flush();
    }
}
