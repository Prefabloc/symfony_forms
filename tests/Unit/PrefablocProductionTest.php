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
}
