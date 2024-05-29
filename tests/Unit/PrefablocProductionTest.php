<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\Prefabloc\PrefablocProduction;
use App\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class PrefablocProductionTest extends KernelTestCase
{
    public function getEntity()
    {
        $societe = new Societe();
        $societe
            ->setLabel('Test');

        $article = new Article();
        $article
            ->setLabel('Article')
            ->setReference('Reference')
            ->setStock(1000)
            ->setCanBeProduced(true)
            ->setSociete($societe);

        $heureCommencement = new \DateTime( '2024-05-27 10:00:00' );
        $heureFin = new \DateTime('2024-05-27 12:00:00');

        return ( new PrefablocProduction() )
            ->setArticle($article)
            ->setStartedAt($heureCommencement)
            ->setEndedAt($heureFin);
    }

    public function assertHasErrors ( PrefablocProduction $production , int $nbr = 0 ){

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($production);
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
        $prod = $this->getEntity();

        $this->assertHasErrors($prod);
    }

    //Pas de champ de saisie alphabétique donc pas de test null / toolong too short
    //Pas de champ numérique donc pas de test sur la range des nombres

    public function testStartBeforeEnd()
    {
        $prod = $this->getEntity();
        $heureDebut = $prod->getStartedAt();

        $prod
            ->setEndedAt($heureDebut->modify('-10 hours'));

        $this->assertHasErrors( $prod , 1);
    }
}
