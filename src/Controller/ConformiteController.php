<?php

namespace App\Controller;

use App\Entity\NonConformite;
use App\Form\NonConformiteType;
use App\Repository\NonConformiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConformiteController extends AbstractController
{
    #[Route('/conformite', name: 'app_conformite')]
    public function index(Request $req, EntityManagerInterface $em, NonConformiteRepository $ncRepo): Response
    {
        date_default_timezone_set('Indian/Reunion');

        // $entityInDb = $ncRepo->findExisting
        $nonConformite = new NonConformite();

        $form = $this->createForm(NonConformiteType::class, $nonConformite);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $nonConformite->setPhotos("");
            $em->persist($nonConformite);
            $em->flush();
            return $this->redirectToRoute('app_success');
        }

        return $this->render('conformite/index.html.twig', [
            'controller_name' => 'ConformiteController',
            "form" => $form->createView(),
            "label" => "Non conformite"
        ]);
    }

    // #[Route('/consommation/essence', name: 'app_consommation_essence')]
    // public function ConsommationEssenceForm(
    //     Request $request,
    //     EntityManagerInterface $entityManager,
    //     MachineRepository $machineRepository,
    //     ConsommationEssenceRepository $consommationEssenceRepository

    // ): Response {
    //     date_default_timezone_set('Indian/Reunion');

    //     $idMachine = $request->query->get('engin');
    //     $machine = $machineRepository->findOneBy(['id' => $idMachine]);

    //     $consoFromDb = $consommationEssenceRepository->getLastElement($machine);

    //     // Vérifie que le dernier élément existe et qu'il n'est pas validé
    //     // Si le contraire, on crée une nouvelle entité
    //     if ($consoFromDb == null || $consoFromDb->isValidated()) {
    //         $conso = new ConsommationEssence();
    //         $conso->setMachine($machine);
    //         $conso->setUser($this->getUser());
    //         $conso->setQuantite(1); // Set la quantité à 1 car 0 impossible
    //         $conso->setUtilisation(1); // Set la quantité à 1 car 0 impossible
    //         $conso->setCreatedAt(new \DateTimeImmutable('now'));
    //         $conso->setValidated(false);
    //         $entityManager->persist($conso);
    //         $entityManager->flush();
    //     } else {
    //         $conso = $consoFromDb;
    //     }

    //     $conso->setQuantite(0); // Reset la quantité pour le front ( si le front renvoie 0 il y aura une erreur)
    //     $conso->setUtilisation(0); // Reset la quantité pour le front ( si le front renvoie 0 il y aura une erreur)
    //     $image = $conso->getPhotoCompteurCarburant(); // On récupère la photo avant que le formulaire n'efface notre entité

    //     $consoForm = $this->createForm(
    //         ConsommationEssenceType::class,
    //         $conso,
    //         ['machine_label' => $machine->getLabel(), "machineType" => $conso->getMachine()->getType()]
    //     );

    //     $consoForm->handleRequest($request);

    //     if ($consoForm->isSubmitted() && $consoForm->isValid()) {

    //         $conso->setValidated(true);
    //         $conso->setPhotoCompteurCarburant($image); // set la photo
    //         $entityManager->persist($conso);
    //         $entityManager->flush();
    //         $this->addFlash('success', 'Saisie de la consommation enregistrée !');

    //         return $this->redirectToRoute('app_success');
    //     }

    //     return $this->render('consommation_essence/index.html.twig', [
    //         'label' => 'Consommation Carburant Machine',
    //         'consoForm' => $consoForm->createView(),
    //         "consoEssenceId" => $conso->getId() // afin de retrouver la session
    //     ]);
    // }
}
