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
        return ( new User())->setUsername('Username')
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
        $societe = new Societe();
        $societe->setLabel('EXFORMAN');
        $user->setSociete($societe);

        $this->assertHasErrors( $user );
    }

    public function testBlank()
    {
      $user = $this->getEntity();
      $user->setUsername('');
      $user->setNom('');
      $user->setPrenom('');
      $user->setPassword('');

      $this->assertHasErrors( $user , 8 );

    }

    public function testTooLong()
    {
        $user = $this->getEntity();
        $user->setUsername('zefjiopzejfopzjkcsdfovnazeocjaézpaidfhjazipdjazpcjzeiochniazedjazjd');
        $user->setNom('zefjiopzejfopzjkcsdfovnazeocjazpaidfhjazéipdjazpcjzeiochniazedjazjd');
        $user->setPrenom('zefjiopzejfopzjkcsdfovnazeocjazpaéidfhjazipdjazpcjzeiochniazedjazjd');
        $user->setPassword('zefjiopzejfopzjkcsdfovénazeocjazpaidfhjazipdjazpcjzeiochniazedjazjd');

        $this->assertHasErrors( $user , 4  );
    }

    public function testNoNumbersInNames()
    {
        $user = $this->getEntity();
        $user->setNom('Chris4fjzpejZE324');
        $user->setPrenom('Benjamin2');

        $this->assertHasErrors( $user , 2 );
    }

    public function testDoubleAccount()
    {
        //Un User avec le username "Username#1" est déjà enregistré dans la BDD de test
        $user2 = $this->getEntity();
        $user2->setUsername('Username#1');

        $this->assertHasErrors( $user2 , 1 );

    }

}
