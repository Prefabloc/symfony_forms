<?php

namespace App\Tests\Unit;

use App\Entity\Pointage;
use App\Entity\Site;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class PointageTest extends KernelTestCase
{
    public function getEntity()
    {
        $user = new User();
        $user
            ->setNom('nom')
            ->setPrenom('prenom')
            ->setPassword('password')
            ->setUsername('username')
            ->setRoles(['ROLE_EMPLOYE']);

        $site = new Site();
        $site
            ->setNomSite('NomSite')
            ->setNoRue('3bis')
            ->setAdresse('Avenue des lilas dorés');

        $heureDepart = new \DateTime('2024-05-27 12:00:00');

        return (new Pointage())
            ->setSite($site)
            ->setEmploye($user)
            ->setArrivedAt($heureDepart);
    }

    public function assertHasErrors(Pointage $pointage, int $nbr = 0)
    {

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($pointage);
        $messages = [];

        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($nbr, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid()
    {
        $pointage = $this->getEntity();

        $this->assertHasErrors( $pointage );
    }

    public function testArrivalBeforeDeparture()
    {
        $pointage = $this->getEntity();
        $heureDepart = $pointage->getArrivedAt();

        $pointage
            ->setDepartedAt($heureDepart->modify('-10 hours'));

        $this->assertHasErrors($pointage , 1);
    }
}
