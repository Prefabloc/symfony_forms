<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LitigePageTest extends WebTestCase
{
    public function testLitigePage(): void
    {
        $client = static::createClient();

        /** @var UserRepository */
        $userRepository = $client->getContainer()->get(UserRepository::class);
        /** @var User */
        $testUser = $userRepository->findOneBy(['username' => 'admin']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/litige');
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h2', 'Litige Qualité');
        $button = $crawler->selectButton('litige_qualite[valider]');
        $this->assertEquals(1, count($button));


    }

}
