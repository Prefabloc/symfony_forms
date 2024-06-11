<?php

namespace App\DataFixtures;

use App\Entity\Machine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MachineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $machine = new Machine();
            $machine->setLabel("Machine" . $i);
            $manager->persist($machine);
        }

        $manager->flush();

    }
}
