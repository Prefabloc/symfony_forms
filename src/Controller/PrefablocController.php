<?php

namespace App\Controller;

use App\Entity\Prefabloc\PrefablocProduction;
use App\Entity\Prefabloc\ReparationPalette;
use App\Entity\Prefabloc\SaisieDeclassement;
use App\Entity\Prefabloc\SaisieProduction;
use App\Form\Prefabloc\PrefablocProductionType;
use App\Form\Prefabloc\ReparationPaletteType;
use App\Form\Prefabloc\SaisieDeclassementType;
use App\Form\Prefabloc\SaisieProductionType;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use App\Repository\Prefabloc\ProductionArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrefablocController extends AbstractController
{
    // #[Route('/prefabloc', name: 'app_prefabloc')]
    // public function index(): Response
    // {
    //     return $this->render('prefabloc/index.html.twig', [
    //         'controller_name' => 'PrefablocController',
    //     ]);
    // }

    #[Route('/prefabloc/production', name: 'app_prefabloc')]
    public function production(Request $request, PrefablocProductionRepository $repository, ProductionArticleRepository $productionArticleRepository): Response
    {
        $url = $request->getUri();
        $entity = $repository->findLastActive();

        $articles = $productionArticleRepository->findBySociete(1);

        $articleChoices = [];
        foreach ($articles as $article) {
            $articleChoices[$article->getReference() . " - " . $article->getLabel()] = $article->getReference();
        }

        $form = $this->createForm(PrefablocProductionType::class, $entity, [
            'disable_fields' => $entity !== null,
            'articles' => $articleChoices  // Pass articles as options to the form
        ]);
        return $this->render('prefabloc/production/index.html.twig', [
            'label' => "Prefabloc Production",
            "url" => $url,
            "form" => $form->createView(),
            "productionId" => $entity == null ? 0 : $entity->getId(),
        ]);
    }


    #[Route('/prefabloc/production/end', name: 'app_prefabloc_end', methods: ['POST'])]
    public function end(Request $request, PrefablocProductionRepository $repository): Response
    {
        $id = $request->query->get('id');

        $repository->endProduction($id);

        return $this->redirectToRoute('app_prefabloc');
    }

    #[Route('/prefabloc/production/start', name: 'app_prefabloc_start', methods: ['POST'])]
    public function start(Request $request, PrefablocProductionRepository $repository): Response
    {
        // Retrieve the raw JSON content from the request
        $jsonContent = $request->getContent();

        // Decode the JSON content to an associative array
        $data = json_decode($jsonContent, true);

        // Access the 'mode' variable from the decoded array
        $mode = $data['mode'] ?? null;

        // Start production with the mode retrieved from the request
        $repository->startProduction($mode);

        // Redirect to another route after processing
        return $this->redirectToRoute('app_prefabloc');
    }

    #[Route('/prefabloc/saisie/declassement', name: 'app_prefacbloc_saisie_declassement')]
    public function prefablocSaisieDeclassement(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prefablocSaisieDeclassement = new SaisieDeclassement();

        $prefablocSaisieDeclassementForm = $this->createForm(SaisieDeclassementType::class, $prefablocSaisieDeclassement);
        $prefablocSaisieDeclassementForm->handleRequest($request);

        if ($prefablocSaisieDeclassementForm->isSubmitted() && $prefablocSaisieDeclassementForm->isValid()) {
            $entityManager->persist($prefablocSaisieDeclassement);
            $entityManager->flush();

            $this->addFlash('success', "Saisie du déclassement enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_saisie_declassement');
        } else {
            return $this->render('prefabloc/SaisieDeclassement.html.twig', ['prefablocSaisieDeclassementForm' => $prefablocSaisieDeclassementForm->createView()]);
        }
    }

    #[Route('/prefabloc/saisie/production', name: 'app_prefacbloc_saisie_production')]
    public function prefablocSaisieProduction(Request $request, EntityManagerInterface $entityManager, PrefablocProductionRepository $repository): Response
    {
        $prefablocSaisieProduction = new SaisieProduction();

        $id = $request->query->get('id');
        $production = $repository->find($id);

        if (!$production) {
            return $this->redirectToRoute('app_prefabloc');
        }

        $prefablocSaisieProduction->setPrefablocProduction($production);
        $prefablocSaisieProductionForm = $this->createForm(SaisieProductionType::class, $prefablocSaisieProduction);
        $prefablocSaisieProductionForm->handleRequest($request);

        if ($prefablocSaisieProductionForm->isSubmitted() && $prefablocSaisieProductionForm->isValid()) {
            $entityManager->persist($prefablocSaisieProduction);
            $entityManager->flush();

            $repository->endProduction($id);

            $this->addFlash('success', "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefabloc');
        } else {
            return $this->render('prefabloc/SaisieProduction.html.twig', ['prefablocSaisieProductionForm' => $prefablocSaisieProductionForm->createView()]);
        }
    }

    #[Route('/prefabloc/saisie/reparation_palette', name: 'app_prefacbloc_reparation_palette')]
    public function prefablocReparationPalette(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prefablocRepartitionPalette = new ReparationPalette();
        $prefablocRepartitionPaletteForm = $this->createForm(ReparationPaletteType::class, $prefablocRepartitionPalette);
        $prefablocRepartitionPaletteForm->handleRequest($request);

        if ($prefablocRepartitionPaletteForm->isSubmitted() && $prefablocRepartitionPaletteForm->isValid()) {
            $entityManager->persist($prefablocRepartitionPalette);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la répartition palette enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_reparation_palette');
        } else {
            return $this->render('prefabloc/SaisieReparationPalette.html.twig', ['prefablocRepartitionPaletteForm' => $prefablocRepartitionPaletteForm->createView()]);
        }
    }
}
