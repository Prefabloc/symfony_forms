<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\Valromex\ValromexSaisieDeclassement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class ValromexSaisieDeclassementTest extends KernelTestCase
{
    public function getEntity()
    {
        return ( new ValromexSaisieDeclassement() )
            ->setArticle('Article')
            ->setMotifDeclassement('MotifDeclassement')
            ->setQuantite(1000);
    }

    public function assertHasErrors ( ValromexSaisieDeclassement $saisieDeclassement , int $nbr = 0 ){

        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($saisieDeclassement);
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
        $saisieDeclassement = $this->getEntity();

        $this->assertHasErrors( $saisieDeclassement );
    }

    public function testBlank()
    {
        $saisieDeclassement = $this->getEntity();
        $saisieDeclassement
            ->setArticle('')
            ->setMotifDeclassement('');

        $this->assertHasErrors( $saisieDeclassement , 4 );
    }

    public function testTooLong()
    {
        $saisieDeclassement = $this->getEntity();
        $saisieDeclassement
            ->setArticle('zeouhfzuioaehnoazidjoaeifjozehjfaeiojdazeiojioazehcoaejoazijazeuiofhaeiojdaozijazeiof')
            ->setMotifDeclassement('zfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfiozezfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfiozezfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfiozezfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfiozezfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfiozezfpjzepjfzejfzejfzeiojfzeiojfzeiofjziojfozeifjozejfziojfzeiojfziofjzeiofjzeiojfziojfozefjozeifjziojfziojfioze');

        $this->assertHasErrors( $saisieDeclassement , 2);
    }

    public function testTooShort()
    {
        $saisieDeclassement = $this->getEntity();
        $saisieDeclassement
            ->setMotifDeclassement('jezoijze');

        $this->assertHasErrors( $saisieDeclassement , 1 );
    }

   public function testPositiveQuantity()
   {
       $saisieDeclassement = $this->getEntity();
       $saisieDeclassement
           ->setQuantite(-40 );

       $this->assertHasErrors( $saisieDeclassement , 1 );
   }

}
