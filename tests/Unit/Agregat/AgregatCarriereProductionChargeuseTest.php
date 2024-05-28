<?php

namespace App\Tests\Unit\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionChargeuse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AgregatCarriereProductionChargeuseTest extends KernelTestCase
{
    public function getEntityAgregatCarriereProductionChargeuse() : AgregatCarriereProductionChargeuse
    {
        return (new AgregatCarriereProductionChargeuse())->setStartedAt(new \DateTimeImmutable())
                                                         ->setEndedAt(new \DateTimeImmutable())
                                                         ->setMode('Mode #1');
    }

    public function assertHasErrors(AgregatCarriereProductionChargeuse $agregatCarriereProductionChargeuse, int $number): void
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($agregatCarriereProductionChargeuse);
        $this->assertCount($number, $errors);
    }

    public function testEntityIsValid()
    {
        $this->assertHasErrors($this->getEntityAgregatCarriereProductionChargeuse(), 0);
    }

    public function testInvalidBlankFIeldMode()
    {
        $this->assertHasErrors(
            $this->getEntityAgregatCarriereProductionChargeuse()->setMode(''), 1
        );
    }

    public function testValidNullFieldEndedAt()
    {
        $this->assertHasErrors(
            $this->getEntityAgregatCarriereProductionChargeuse()->setEndedAt(null), 0
        );
    }
}
