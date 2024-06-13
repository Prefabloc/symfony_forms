<?php

namespace App\Controller;

use App\Entity\ConsommationEssence;
use App\Form\ConsommationEssenceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsommationEssenceController extends AbstractController
{
    #[Route('/consommation/essence', name: 'app_consommation_essence')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        date_default_timezone_set('Indian/Reunion');

        $conso = new ConsommationEssence();
        $consoForm = $this->createForm(ConsommationEssenceType::class, $conso);
        $consoForm->handleRequest($request);

        if ($consoForm->isSubmitted() && $consoForm->isValid()) {
            $conso = $consoForm->getData();

            // Vérifiez si le champ createdAt est null et définissez-le à la date du jour
            if ($conso->getCreatedAt() === null) {
                $conso->setCreatedAt(new \DateTimeImmutable('now'));
            }

            $entityManager->persist($conso);
            $entityManager->flush();
            $this->addFlash('success', "Saisie de la consommation enregistrée !");
        }

        return $this->render('consommation_essence/index.html.twig', [
            'label' => 'Consommation Carburant Machine',
            'consoForm' => $consoForm->createView()
        ]);
    }
}
