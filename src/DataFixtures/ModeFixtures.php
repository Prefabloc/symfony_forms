<?php

namespace App\DataFixtures;

use App\Entity\Mode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModeFixtures extends Fixture
{
    public function load( ObjectManager $manager )
    {
        $modeList = [
            ['Remblais' , 'AgregatCarriereProductionChargeuse'],
            ['Aménagement Piste' , 'AgregatCarriereProductionChargeuse'],
            ['Extraction' , 'AgregatCarriereProductionPelle'],
            ['Découverture' , 'AgregatCarriereProductionPelle'],
            ['Chargement' , 'AgregatCarriereProductionPelle'],
            ['Brise-roche' , 'AgregatCarriereProductionPelle&&AgregatConcassageProductionPelle'],
            ['Aménagement' , 'AgregatCarriereProductionPelle&&AgregatConcassageProductionPelle'],
            ['Alimentation' , 'AgregatConcassageProductionPelle']
        ];



        foreach ( $modeList as $modes ) {
            $mode = new Mode();
            $mode
                ->setNom( $modes[0] )
                ->setAffiliation( $modes[1]);

            $manager->persist($mode);
        }

        $manager->flush();
    }
}