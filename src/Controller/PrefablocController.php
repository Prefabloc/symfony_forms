<?php

namespace App\Controller;

use App\Entity\LignePalettisation;
use App\Entity\Palettisation;
use App\Entity\Prefabloc\PrefablocProduction;
use App\Entity\Prefabloc\ReparationPalette;
use App\Entity\Prefabloc\SaisieDeclassement;
use App\Entity\Prefabloc\SaisieProduction;
use App\Entity\Prefabloc\SaisieProductionInfo;
use App\Form\Prefabloc\PrefablocProductionType;
use App\Form\Prefabloc\ReparationPaletteType;
use App\Form\Prefabloc\SaisieDeclassementType;
use App\Form\Prefabloc\SaisieProductionInfoType;
use App\Form\Prefabloc\SaisieProductionType;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use App\Service\ArticleDTO;
use App\Repository\ArticleRepository;
use DateTime;
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
            'articleLabel' => $articleLabel,
            "productionType" => "prefabloc"
        ]);
    }

    #[Route('/palettisation', name: 'palettisation')]
    public function palettisation(Request $request, ArticleRepository $repository, EntityManagerInterface $em): Response
    {
        date_default_timezone_set('Indian/Reunion');

        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);

            $entity = new Palettisation();

            for ($i = 0; $i < count($data); $i++) {

                $element = $data[$i];
                $article = $repository->findOneBy([
                    "id" => $element["idArticle"]
                ]);

                if ($article == null) {
                    return new JsonResponse(['status' => 'error', 'message' => 'Article non trouvé'], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
                $ligne = new LignePalettisation();
                $ligne->setNbPalette($element["nbrPalettes"]);
                $ligne->setUnite($element["unite"]);
                $ligne->setPalettisation($entity);
                $ligne->setArticle($article);
                $em->persist($ligne);
            }
            $entity->setCreatedAt(new DateTime('now'));
            $em->persist($entity);
            $em->flush();
            return new JsonResponse(['status' => 'success'], Response::HTTP_OK);
        }
        return $this->render('prefabloc/Paletisation.html.twig', [
            'label' => "Palettisation",
        ]);
    }

    #[Route('/autocomplete', name: 'autocomplete')]
    public function autocomplete(ArticleRepository $articleRepository, Request $request): Response
    {

        $mot = $request->query->get('mot');

        if (!$mot) {
            return new JsonResponse([]);
        }

        $results = $articleRepository->findByTerm($mot, $this->getUser()->getSociete()->getId());
        $data = array_map(function ($article) {
            return new ArticleDTO($article->getId(), $article->getLabel(), $article->getReference(), $article->getSociete()->getLabel(), $article->getStock(), $article->getAbreviation());
        }, $results);

        return new JsonResponse($data);
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
        $timezone = new \DateTimeZone('Indian/Reunion');
        $startedAt = new \DateTime('now', $timezone);
        $prefablocProduction->setStartedAt($startedAt);

        $entityManager->persist($prefablocProduction);
        $entityManager->flush();

        // Redirect to another route after processing
        return $this->redirectToRoute('app_prefabloc_production');
    }

    #[Route('/saisie/declassement', name: 'saisie_declassement')]
    public function prefablocSaisieDeclassement(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prefablocSaisieDeclassement = new SaisieDeclassement();

        $prefablocSaisieDeclassementForm = $this->createForm(SaisieDeclassementType::class, $prefablocSaisieDeclassement);
        $prefablocSaisieDeclassementForm->handleRequest($request);

        if ($prefablocSaisieDeclassementForm->isSubmitted() && $prefablocSaisieDeclassementForm->isValid()) {
            $entityManager->persist($prefablocSaisieDeclassement);
            $entityManager->flush();

            $this->addFlash('success', "Saisie du déclassement enregistrée !");
            return $this->redirectToRoute('app_prefabloc_saisie_declassement');
        } else {
            return $this->render('prefabloc/SaisieDeclassement.html.twig', ['prefablocSaisieDeclassementForm' => $prefablocSaisieDeclassementForm->createView()]);
        }
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
        $prefablocSaisieProduction->setTypeFabrication($prefablocSaisieProduction->getPrefablocProduction()->getArticle()->getAbreviation());
        $prefablocSaisieProductionForm = $this->createForm(SaisieProductionType::class, $prefablocSaisieProduction, [
            "reference" => $prefablocSaisieProduction->getPrefablocProduction()->getArticle()->getReference(),
            "typeFabrication" => $prefablocSaisieProduction->getTypeFabrication()
        ]);

        $prefablocSaisieProductionForm->handleRequest($request);

        if ($prefablocSaisieProductionForm->isSubmitted() && $prefablocSaisieProductionForm->isValid()) {

            $entityManager->persist($prefablocSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefabloc_saisie_production2', [
                "id" => $prefablocSaisieProduction->getPrefablocProduction()->getId()
            ]);

        } else {
            return $this->render('prefabloc/SaisieProduction.html.twig', ['prefablocSaisieProductionForm' => $prefablocSaisieProductionForm->createView()]);
        }
    }

    #[Route('/saisie/production/info', name: 'saisie_production2')]
    public function prefablocSaisieProductionInfo(Request $request, EntityManagerInterface $entityManager, PrefablocProductionRepository $repository): Response
    {

        $id = $request->query->get('id');
        $production = $repository->find($id);

        if (!$production) {
            return $this->redirectToRoute('app_prefabloc_production');
        }

        $prefablocSaisieProduction = new SaisieProductionInfo();
        $prefablocSaisieProduction->setProduction($production);
        $prefablocSaisieProductionForm = $this->createForm(SaisieProductionInfoType::class, $prefablocSaisieProduction);

        $prefablocSaisieProductionForm->handleRequest($request);

        if ($prefablocSaisieProductionForm->isSubmitted() && $prefablocSaisieProductionForm->isValid()) {
            $timezone = new \DateTimeZone('Indian/Reunion');
            $endedAt = new \DateTime('now', $timezone);
            $production->setEndedAt($endedAt);
            $prefablocSaisieProduction->setPhoto("");

            // Persist changes to the database
            $entityManager->persist($production);
            $entityManager->persist($prefablocSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefabloc_production');
        } else {
            return $this->render('prefabloc/SaisieProductionInfo.html.twig', ['prefablocSaisieProductionForm' => $prefablocSaisieProductionForm->createView()]);
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
