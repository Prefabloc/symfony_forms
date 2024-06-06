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
use App\Repository\MotifDeclassementRepository;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use App\Service\ArticleDTO;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/prefabloc', name: 'app_prefabloc_')]
class PrefablocController extends AbstractController
{
    // #[Route('/prefabloc', name: 'app_prefabloc')]
    // public function index(): Response
    // {
    //     return $this->render('prefabloc/index.html.twig', [
    //         'controller_name' => 'PrefablocController',
    //     ]);
    // }

    #[Route('/production', name: 'production')]
    public function production(Request $request, PrefablocProductionRepository $repository): Response
    {
        $url = $request->getUri();
        $articleLabel = '';
        $entity = $repository->findLastActive();

        if ($entity != null) {
            $article = $entity->getArticle();
            $articleLabel = $article->getLabel();
        }

        $form = $this->createForm(PrefablocProductionType::class, $entity);

        return $this->render('prefabloc/production/index.html.twig', [
            'label' => "Prefabloc Production",
            "url" => $url,
            "productionForm" => $form->createView(),
            "productionId" => $entity == null ? 0 : $entity->getId(),
            'articleLabel' => $articleLabel
        ]);
    }

    #[Route('/production/start', name: 'start', methods: ['POST'])]
    public function start(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response
    {
        // Retrieve the raw JSON content from the request
        $jsonContent = $request->getContent();

        // Decode the JSON content to an associative array
        $data = json_decode($jsonContent, true);

        // Access the 'idArticle' variable from the decoded array
        $articleId = $data['idArticle'] ?? null;
        $article = $articleRepository->find($articleId);

        $prefablocProduction = new PrefablocProduction();
        $prefablocProduction->setArticle($article);
        $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
        $startedAt = new \DateTime('now', $timezone);
        $prefablocProduction->setStartedAt($startedAt);

        $entityManager->persist($prefablocProduction);
        $entityManager->flush();

        // Redirect to another route after processing
        return $this->redirectToRoute('app_prefabloc_production');
    }

    #[Route('/saisie/declassement', name: 'saisie_declassement')]
    public function prefablocSaisieDeclassement(): Response
    {
        $prefablocSaisieDeclassement = new SaisieDeclassement();
        $prefablocSaisieDeclassementForm = $this->createForm(SaisieDeclassementType::class, $prefablocSaisieDeclassement);

        return $this->render('prefabloc/SaisieDeclassement.html.twig', [
            'prefablocSaisieDeclassementForm' => $prefablocSaisieDeclassementForm->createView()
        ]);
    }

    #[Route('/saisie/declassement/validate' , name: 'saisie_declassement_validate')]
    public function prefablocSaisieDeclassementValidate( Request $request , EntityManagerInterface $entityManager , ArticleRepository $articleRepository , MotifDeclassementRepository $motifDeclassementRepository )
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent, true);

        $articleId = $data['idArticle'] ?? null;
        $article = $articleRepository->find($articleId);

        $motifDeclassementId = $data['idMotif'] ?? null;
        $motifDeclassement = $motifDeclassementRepository->find($motifDeclassementId);

        $quantite = $data['qte'] ?? null;

        $prefablocSaisieDeclassement = new SaisieDeclassement();
        $prefablocSaisieDeclassement
            ->setArticle($article)
            ->setMotifDeclassement($motifDeclassement)
            ->setQuantite($quantite);

        $entityManager->persist($prefablocSaisieDeclassement);
        $entityManager->flush();

        $this->addFlash('success' , 'Saisie Déclassement réussie.');
        return $this->redirectToRoute('app_prefabloc_saisie_declassement');
    }

    #[Route('/saisie/production', name: 'saisie_production')]
    public function prefablocSaisieProduction(Request $request, EntityManagerInterface $entityManager, PrefablocProductionRepository $repository): Response
    {
        $prefablocSaisieProduction = new SaisieProduction();

        $id = $request->query->get('id');
        $production = $repository->find($id);

        if (!$production) {
            return $this->redirectToRoute('app_prefabloc_production');
        }

        $prefablocSaisieProduction->setPrefablocProduction($production);
        $prefablocSaisieProductionForm = $this->createForm(SaisieProductionType::class, $prefablocSaisieProduction);
        $prefablocSaisieProductionForm->handleRequest($request);

        if ($prefablocSaisieProductionForm->isSubmitted() && $prefablocSaisieProductionForm->isValid()) {
            $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
            $endedAt = new \DateTime('now', $timezone);
            $production->setEndedAt($endedAt);

            // Persist changes to the database
            $entityManager->persist($production);
            $entityManager->persist($prefablocSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefabloc_production');
        } else {
            return $this->render('prefabloc/SaisieProduction.html.twig', ['prefablocSaisieProductionForm' => $prefablocSaisieProductionForm->createView()]);
        }
    }

    #[Route('/saisie/reparation_palette', name: 'reparation_palette')]
    public function prefablocReparationPalette(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prefablocRepartitionPalette = new ReparationPalette();
        $prefablocRepartitionPaletteForm = $this->createForm(ReparationPaletteType::class, $prefablocRepartitionPalette);
        $prefablocRepartitionPaletteForm->handleRequest($request);

        if ($prefablocRepartitionPaletteForm->isSubmitted() && $prefablocRepartitionPaletteForm->isValid()) {
            $entityManager->persist($prefablocRepartitionPalette);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la répartition palette enregistrée !");
            return $this->redirectToRoute('app_prefabloc_reparation_palette');
        } else {
            return $this->render('prefabloc/SaisieReparationPalette.html.twig', ['prefablocRepartitionPaletteForm' => $prefablocRepartitionPaletteForm->createView()]);
        }
    }
}
