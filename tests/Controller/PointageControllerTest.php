<?php

namespace App\Tests\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PointageControllerTest extends WebTestCase
{
    public function testRoad(): void
    {
        //On crée le client
        $client = static::createClient();
        //On va chercher le répo des User afin de simuler le compte d'un user existant
        $userRepo = $client->getContainer()->get(UserRepository::class);
        $prefablocUser = $userRepo->findOneBy(['username' => 'prefabloc']);
        //On connecte le fameux user au client
        $client->loginUser($prefablocUser);

        $client->request('GET' , '/pointage/edit/CARRIERE_PIERREFOND');
        $this->assertResponseIsSuccessful();
    }
}
