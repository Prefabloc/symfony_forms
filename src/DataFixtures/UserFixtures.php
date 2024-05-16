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
    ){

    }

    public function load(ObjectManager $manager): void
    {
        $societeList = $manager->getRepository(Societe::class)->findAll();

        $user = (new User());
        $user->setRoles(['ROLE_ADMIN'])
            ->setUsername('admin')
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setNom('DOE')
            ->setPrenom('John')
            ->setSociete($societeList[0]);
        $manager->persist($user);

        $user = (new User());
        $user->setRoles(['ROLE_AGREGAT'])
            ->setUsername('Captain America')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setNom('CADET')
            ->setPrenom('Steve')
            ->setSociete($societeList[1]);;
        $manager->persist($user);

        $user = (new User());;
        $user->setRoles(['ROLE_BTPVALROMEX'])
            ->setUsername('Doctor Strange')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setNom('DOE')
            ->setPrenom('Jeremy')
            ->setSociete($societeList[2]);;
        $manager->persist($user);

        $user = (new User());
        $user->setRoles(['ROLE_PREFABLOC'])
            ->setUsername('Iron Man')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setNom('HOARAU')
            ->setPrenom('Christophe')
            ->setSociete($societeList[0]);;
        $manager->persist($user);

        $user = (new User());
        $user->setRoles(['ROLE_EXFORMAN'])
            ->setUsername('Black Widow')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setNom('DUCASSE')
            ->setPrenom('Amelie')
            ->setSociete($societeList[4]);;
        $manager->persist($user);

        $user = (new User());
        $user->setRoles(['ROLE_ACCUEIL'])
            ->setUsername('JD')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setNom('Doe')
            ->setPrenom('John')
            ->setSociete($societeList[3]);;
        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SocieteFixtures::class];
    }
}
