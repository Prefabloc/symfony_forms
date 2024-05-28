<?php

namespace App\Tests\Unit;

use App\Entity\LitigeQualite;
use App\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class LitigeTest extends KernelTestCase
{
    public function getEntity() : LitigeQualite
    {
        return (new LitigeQualite())->setSociete(new Societe())
                                    ->setClients('Client01')
                                    ->setBlv('BL123')
                                    ->setArticle('Bloc Beton')
                                    ->setVolume(3)
                                    ->setConformite('cassé');
    }

    public function assertHasErrors(LitigeQualite $litige, int $number = 0)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($litige);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error)
        {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidBlankFields()
    {
        $litige = $this->getEntity()->setClients('')
                                    ->setBlv('')
                                    ->setArticle('')
                                    ->setConformite('');
        $this->assertHasErrors($litige, 5);
    }

    public function testInvalidClientsLength()
    {
        $this->assertHasErrors($this->getEntity()->setClients('a'), 1);
        $this->assertHasErrors($this->getEntity()
                 ->setClients('Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch'), 1
        );
    }

    public function testVolumeGreaterThanZero()
    {
        $this->assertHasErrors($this->getEntity()->setVolume(0), 1);
    }
}
