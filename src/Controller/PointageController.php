<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PointageController extends AbstractController
{
    #[Route('/pointage', name: 'app_pointage')]
    public function index(): Response
    {
        return $this->render('pointage/index.html.twig', [
            'controller_name' => 'PointageController',
        ]);
    }
}
