<?php

namespace App\Tests\Unit;

use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class UserTest extends KernelTestCase
{
    public function getEntity()
    {
        return ( new User())->setUsername('Username#1')
            ->setRoles(['ROLE_USER'])
            ->setPassword('adminadmin')
            ->setNom('GRONDIN')
            ->setPrenom('Didier');
    }

    public function assertHasErrors ( User $user , int $nbr = 0 ){

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($user);
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
        $user = $this->getEntity();

        $this->assertHasErrors( $user );
    }

    public function testBlank()
    {
      $user = $this->getEntity();
      $user->setUsername('');
      $user->setNom('');
      $user->setPrenom('');
      $user->setPassword('');

      $this->assertHasErrors( $user , 4 );

    }


}
