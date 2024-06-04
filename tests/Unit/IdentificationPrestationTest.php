<?php

namespace App\Tests\Unit;

use App\Entity\IdentificationPrestation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class IdentificationPrestationTest extends KernelTestCase
{
    public function getEntity()
    {
        $heureArrivee = new \DateTime('2024-05-27 10:00:00');
        $heureDepart = new \DateTime('2024-05-27 12:00:00');

        return ( new IdentificationPrestation() )
            ->setSociete( 'EXFORMAN' )
            ->setNomPrenom('NOMPrenom')
            ->setPrestation('Prestation')
            ->setCommanditaire('Commanditaire')
            ->setHeureArrivee($heureArrivee)
            ->setHeureDepart($heureDepart);
    }

    public function assertHasErrors ( IdentificationPrestation $identificationPrestation , int $nbr = 0 ){

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($identificationPrestation);
        $messages = [] ;

        /** @var ConstraintViolation $error */
        foreach ($errors as $error)
        {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($nbr, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid(): void
    {
        $idPresta = $this->getEntity();

        $this->assertHasErrors( $idPresta , 0 );
    }

    public function testBlank()
    {
        $idPresta = $this->getEntity();
        $idPresta
            ->setSociete( '' )
            ->setNomPrenom('')
            ->setPrestation('')
            ->setCommanditaire('');

        $this->assertHasErrors( $idPresta , 8 );
    }

    public function testTooLong()
    {
        $idPresta = $this->getEntity();
        $idPresta
            ->setSociete( 'iofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaefiofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaef' )
            ->setNomPrenom('iofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaefiofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaef')
            ->setPrestation('iofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaefiofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaef')
            ->setCommanditaire('iofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaefiofhzeofhjpzeifhujoevbzpehcziopnpzeiocjpzeijcpziehpaef');

        $this->assertHasErrors( $idPresta , 4 );
    }

    public function testNoNumbersInNames()
    {
        $idPresta = $this->getEntity();
        $idPresta
            ->setNomPrenom('JFDOIJdjazdjééééjhfsfô234234');

        $this->assertHasErrors( $idPresta , 1 );
    }

    public function testArrivalBeforeDeparture()
    {
        $idPresta = $this->getEntity();
        $heureDepart = $idPresta->getHeureDepart();

        $idPresta
            ->setHeureArrivee($heureDepart->modify('-10 hours'));

        $this->assertHasErrors($idPresta , 1);
    }
}
