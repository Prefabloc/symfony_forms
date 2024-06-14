<?php

namespace App\Controller;

use App\Entity\ConsommationEssence;
use App\Form\ConsommationEssenceType;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsommationEssenceController extends AbstractController
{
    #[Route('/consommation/essence', name: 'app_consommation_essence')]
    public function ConsommationEssenceForm(Request $request,
                                            EntityManagerInterface $entityManager,
                                            MachineRepository $machineRepository
    ): Response
    {
        date_default_timezone_set('Indian/Reunion');

        $idMachine = $request->query->get('machine');
        $machine = $machineRepository->findOneBy(['id' => $idMachine ]);

        $conso = new ConsommationEssence();
        $conso->setMachine($machine);
        $consoForm = $this->createForm(
            ConsommationEssenceType::class,
            $conso,
            [ 'machine_id' => $idMachine ]
        );
        $consoForm->handleRequest($request);

        if ($consoForm->isSubmitted() && $consoForm->isValid()) {
            $conso = $consoForm->getData();

            // Vérifiez si le champ createdAt est null et définissez-le à la date du jour
            if ($conso->getCreatedAt() === null) {
                $conso->setCreatedAt(new \DateTimeImmutable('now'));
            }

            $entityManager->persist($conso);
            $entityManager->flush();
            $this->addFlash('success', 'Saisie de la consommation enregistrée !');
        }

        return $this->render('consommation_essence/index.html.twig', [
            'label' => 'Consommation Carburant Machine',
            'consoForm' => $consoForm->createView()
        ]);
    }
}
