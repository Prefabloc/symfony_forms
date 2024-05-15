<?php

namespace App\Controller;

use App\Entity\LitigeQualite;
use App\Entity\Societe;
use App\Form\LitigeQualiteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LitigeController extends AbstractController
{
    #[Route('/litige', name: 'app_litige', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $url = $request->getUri();

        $form = $this->createForm(LitigeQualiteType::class);

        $litige = new LitigeQualite();
        $litigeForm = $this->createForm(LitigeQualiteType::class, $litige);
        $litigeForm->handleRequest($request);

        if ($litigeForm->isSubmitted() && $litigeForm->isValid()) {
            $entityManager->persist($litige);
            $entityManager->flush();

            $this->addFlash('success', "Saisie du litige enregistrée !");
        }

        return $this->render('litige/index.html.twig', [
            'controller_name' => 'LitigeController',
            'label' => 'Litige Qualité',
            'url' => $url,
            'litigeForm' => $form->createView(),
        ]);
    }
}
