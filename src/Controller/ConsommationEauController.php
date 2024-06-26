<?php

namespace App\Controller;

use App\Entity\ConsommationEau;
use App\Form\ConsommationEauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsommationEauController extends AbstractController
{
    #[Route('/consommation/eau', name: 'app_consommation_eau')]
    public function index(Request $req, EntityManagerInterface $em): Response
    {
        date_default_timezone_set('Indian/Reunion');

        // $entityInDb = $ncRepo->findExisting
        $entity = new ConsommationEau();

        $form = $this->createForm(ConsommationEauType::class, $entity);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setPhoto("");
            $em->persist($entity);
            $em->flush();
            return $this->redirectToRoute('app_success');
        }

        return $this->render('consommation_eau/index.html.twig', [
            "form" => $form->createView(),
            "label" => "Consommation Eau"
        ]);
    }
}
