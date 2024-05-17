<?php

namespace App\Tests\Unit;

use App\Entity\LitigeQualite;
use App\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $litige = $this->getEntity();

        $errors = $container->get('validator')->validate($litige);
        $this->assertCount(0, $errors);
    }

    public function testInvalidField()
    {
        self::bootKernel();
        $container = static::getContainer();

        $litige = $this->getEntity();
        $litige ->setClients('')
                ->setBlv('')
                ->setArticle('')
                ->setVolume(0)
                ->setConformite('');

        $errors = $container->get('validator')->validate($litige);
        $this->assertCount(6, $errors);
    }

}
