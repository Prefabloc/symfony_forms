<?php

namespace App\DataFixtures;

use App\Entity\MotifDeclassement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MotifDeclassementFixtures extends Fixture
{
    public function load( ObjectManager $manager )
    {
        $motifs = [
            'DémoulageNC' ,
            'HauteurNC' ,
            'CouleurNC' ,
            'QualitéNC' ,
            'Fissure'
        ];

        foreach ( $motifs as $motif ){
            $motifDeclassement = ( new MotifDeclassement())->setMotif($motif);
            $manager->persist($motifDeclassement);
        }

        $manager->flush();
    }
}