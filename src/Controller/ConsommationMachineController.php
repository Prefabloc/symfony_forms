<?php

namespace App\Controller;

use App\Entity\ConsommationMachine;
use App\Form\ConsommationMachineType;
use App\Repository\ConsommationMachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsommationMachineController extends AbstractController
{
    #[Route('/consommation_machine', name: 'app_consommation_machine')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conso = new ConsommationMachine();
        $consoForm = $this->createForm(ConsommationMachineType::class, $conso);
        $consoForm->handleRequest($request);

        if ($consoForm->isSubmitted() && $consoForm->isValid()) {
            $entityManager->persist($conso);
            $entityManager->flush();
            $this->addFlash('success', "Saisie de la consommation enregistrée !");
        }

        return $this->render('consommation_machine/index.html.twig', [
            'controller_name' => 'ConsommationMachineController',
            'label' => 'Consommation machine',
            'consoForm' => $consoForm->createView(),
        ]);
    }
}
