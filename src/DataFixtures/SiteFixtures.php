<?php

namespace App\DataFixtures;

use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SiteFixtures extends Fixture
{
    public function load( ObjectManager $manager ): void
    {
        $sites = [
            'PREFABLOC_Petite_Ile',
            'PREFABLOC_Pierrefonds',
            'BETON_Pierrefonds',
            'BETON_StJoseph',
            'BTP_Valromex',
            'EXFORMAN',
            'AGREGAT_StJoseph',
            'AGREGAT_Pierrefonds'
        ];

        foreach ( $sites as $nomSite ) {
            $site =  ( new Site())->setNom($nomSite);
            $manager->persist($site);
        }

        $manager->flush();
    }

}