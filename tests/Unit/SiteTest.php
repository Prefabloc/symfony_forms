<?php

namespace App\Tests\Unit;

use App\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class SiteTest extends KernelTestCase
{
    public function getEntity()
    {
        return (new Site())
            ->setNomSite('site1')
            ->setNoRue('25ter')
            ->setAdresse('Avenue de la rue avenante');
    }

    public function assertHasErrors(Site $site , int $nbr = 0)
    {

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($site);
        $messages = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($nbr, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid()
    {
        $site = $this->getEntity();

        $this->assertHasErrors( $site );
    }

    public function testBlank()
    {
        $site = $this->getEntity();

        $site
            ->setAdresse('')
            ->setNoRue('')
            ->setNomSite('');

        $this->assertHasErrors($site , 2 );
    }

    public function testTooLong()
    {
        $site = $this->getEntity();

        $site
            ->setAdresse('zehfozejozeijfozeijfzeiofhozeijfzeiojfziohjfzeiojfzeiojfozeijfzioejfozeijfozeijfozeijfoizejfiozejfzehfozejozeijfozeijfzeiofhozeijfzeiojfziohjfzeiojfzeiojfozeijfzioejfozeijfozeijfozeijfoizejfiozejf')
            ->setNoRue('zehfozejozeijfozeijfzeiofhozeijfzeiojfziohjfzeiojfzeiojfozeijfzioejfozeijfozeijfozeijfoizejfiozejf')
            ->setNomSite('zehfozejozeijfozeijfzeiofhozeijfzeiojfziohjfzeiojfzeiojfozeijfzioejfozeijfozeijfozeijfoizejfiozejf');

        $this->assertHasErrors($site , 3 );
    }
}
