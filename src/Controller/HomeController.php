<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController {

    #[Route('/' , name: 'app_acceuil')]
    public function home(UserRepository $userRepository) : Response
    {
        return $this->render('accueil.html.twig');
    }
}