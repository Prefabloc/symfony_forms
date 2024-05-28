<?php

namespace App\Tests\Unit;

use App\Entity\Valromex\ValromexSaisieProduction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class ValromexSaisieProductionTest extends KernelTestCase
{
    public function getEntity()
    {
        return ( new ValromexSaisieProduction() )
            ->setQte04('10')
            ->setQte610('10')
            ->setQteCEM('10')
            ->setQteAdjuvant('10')
            ->setQteHuile('10')
            ->setQteEau('10');
    }

    public function assertHasErrors ( ValromexSaisieProduction $saisieProduction , int $nbr = 0 ){

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($saisieProduction);
        $messages = [] ;

        /** @var ConstraintViolation $error */
        foreach ($errors as $error)
        {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($nbr, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid()
    {
        $saisieProduction = $this->getEntity();

        $this->assertHasErrors($saisieProduction);
    }

    //Pas de testBlank car uniquement des champs numerique donc pas de blank possible

    public function testNbrNotPositive()
    {
        $saisieProduction = $this->getEntity();
        $saisieProduction
            ->setQte04( -5)
            ->setQte610(-5)
            ->setQteCEM(-5)
            ->setQteAdjuvant(-5)
            ->setQteEau(-5)
            ->setQteHuile(-5);

        $this->assertHasErrors( $saisieProduction , 6 );
    }

    public function testNbrNotTooExcessive()
    {
        $saisieProduction = $this->getEntity();
        $saisieProduction
            ->setQte04( 100000000000)
            ->setQte610(100000000000)
            ->setQteCEM(100000000000)
            ->setQteAdjuvant(100000000000)
            ->setQteEau(100000000000)
            ->setQteHuile(100000000000);

        $this->assertHasErrors( $saisieProduction , 6 );
    }
}
