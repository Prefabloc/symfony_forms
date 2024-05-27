<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleTest extends KernelTestCase
{
    public function getEntityArticle() : Article
    {
        return (new Article())->setReference('REF123')
                              ->setLabel('Article #1')
                              ->setSociete(new Societe())
                              ->setCanBeProduced(true);
    }

    public function assertHasErrors(Article $article, int $number = 0)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($article);
        $this->assertCount($number, $errors);
    }

    public function testEntityArticleIsValid()
    {
        $this->assertHasErrors($this->getEntityArticle(), 0);
    }

    public function testInvalidBlankFieldsArticle()
    {
        $article = $this->getEntityArticle()->setReference('')
                                            ->setLabel('');

        $this->assertHasErrors($article, 2);
    }

    public function testInvalidFieldCanBeProduced()
    {
        $this->assertHasErrors($this->getEntityArticle()
                                    ->setCanBeProduced(''), 1);
        $this->assertHasErrors($this->getEntityArticle()
                                    ->setCanBeProduced(false), 1);
    }
}
