<?php

namespace App\Tests\Unit;

use App\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;


class SocieteTest extends KernelTestCase
{
    public function getEntity()
    {
        return ( new Societe())->setLabel('Label#1');
    }

    public function assertHasErrors ( Societe $societe , int $nbr = 0 ){
        //Démarre le kernel de Symfony
        self::bootKernel();
        //Récupère le service de validation depuis le container et valide l'objet
        $errors = self::getContainer()->get('validator')->validate($societe);
        //Initialisation du tableau qui va récupérer les messages d'erreur
        $messages = [] ;

        /** @var ConstraintViolation $error */
        //On boucle sur chaque erreur récupérée
        foreach ($errors as $error)
        {
            //Pour chaque erreur on rajoute au tableau le chemin de la propriété et le message d'erreur
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        //On vérifie que le nombre d'erreur est égal à nbr, et on affiche les messages d'erreur en cas d'échec
        $this->assertCount($nbr, $errors, implode(', ', $messages));
    }

    public function testEntityIsValid(): void
    {
        //On boot le kernel
        self::bootKernel();
        //Création du container
        $container = static::getContainer();
        //Création de l'instance de l'entité qu'on teste
        $societe = $this->getEntity();

        //On stocke les erreurs dans la variable error
        $errors = $container->get('validator')->validate($societe);
        //On s'assure que le nombre d'erreur est à 0
        $this->assertCount( 0 , $errors );
    }

    public function testBlankName() {

        $societe = $this->getEntity();
        $societe->setLabel('');

        $this->assertHasErrors( $societe , 2 );
    }

    public function testLongName() {

        $societe = $this->getEntity();
        $societe->setLabel('ZEFHJziedfjpadjazepjdaz^djkpaojdazeopdkjazà)^dkazopjczseijcazdzeocnazpxjqopsjkczpaedjaziojdpazjxa');

        $this->assertHasErrors( $societe , 1 );
    }

}
