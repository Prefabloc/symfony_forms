<?php

namespace App\Controller;

use App\Entity\Signalement;
use App\Form\SignalementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignalementController extends AbstractController
{
    #[Route('/signalement', name: 'app_signalement')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $url = $request->getUri();
        $signalement = new Signalement();
        $signalementForm = $this->createForm(SignalementType::class, $signalement);
        $signalementForm->handleRequest($request);

        if ($signalementForm->isSubmitted() && $signalementForm->isValid()) {
            $entityManager->persist($signalement);
            $entityManager->flush();
            $this->addFlash('succes', "Saisie du signalement enregistré !");
        }
        return $this->render('includes/_modalSignalement.html.twig', [
            'controller_name' => 'SignalementController',
            'label' => 'Signalement',
            'url' => $url,
            'signalementForm' => $signalementForm->createView()
        ]);
    }
}
