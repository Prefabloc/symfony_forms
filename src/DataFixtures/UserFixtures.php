<?php

namespace App\DataFixtures;

use App\Entity\Societe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {

    }

    public function load(ObjectManager $manager): void
    {
        $societeList = $manager->getRepository(Societe::class)->findAll();

        $usersData = [
            ['ROLE_ADMIN', 'admin', 0 , 'SOCIETE0'], // Prefabloc
            ['ROLE_PREFABLOC', 'prefabloc', 0 , 'SOCIETE0'], // Prefabloc
            ['ROLE_AGREGAT', 'agregat', 1, 'SOCIETE1'], // Agregat
            ['ROLE_BTPVALROMEX', 'btpvalromex', 2, 'SOCIETE2'], // BTP VALROMEX
            ['ROLE_EXFORMAN', 'exforman', 4, 'SOCIETE3'],  // PFB Beton
            ['ROLE_ACCUEIL', 'accueil', 1, 'SOCIETE0'], // Prefabloc
        ];

        foreach ($usersData as $userData) {
            $user = (new User());
            $user->setRoles([$userData[0]])
                ->setUsername($userData[1])
                ->setPassword($this->hasher->hashPassword($user, $userData[1]))
                ->setNom($userData[1])
                ->setPrenom($userData[1])
                ->setSociete($this->getReference( $userData[3] ));
            $manager->persist($user);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [SocieteFixtures::class];
    }
}
