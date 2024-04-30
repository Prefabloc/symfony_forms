<?php

namespace App\Controller;

use App\Entity\Prefabloc\PrefablocSaisieProduction;
use App\Entity\Prefabloc\RepartitionPalette;
use App\Entity\Prefabloc\SaisieDeclassement;
use App\Entity\Prefabloc\SaisieProduction;
use App\Form\Prefabloc\PrefablocProductionType;
use App\Form\Prefabloc\PrefablocSaisieProductionType;
use App\Form\Prefabloc\RepartitionPaletteType;
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


        $consommation = new SaisieProduction();
        $consommation->setProduction($entity);

        $saisieForm = $this->createForm(SaisieProductionType::class, $consommation, []);

        // dd($saisieForm->createView());
        return $this->render('production/simple_select.html.twig', [
            'label' => "Prefabloc Production",
            "url" => $url,
            "form" => $form->createView(),
            "saisie" => $saisieForm->createView(),
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

    #[Route('/prefabloc/saisie/declassement' , name : 'app_prefacbloc_saisie_declassement')]
    public function prefablocSaisieDeclassement(Request $request , EntityManagerInterface $entityManager ) : Response
    {
        $prefablocSaisieDeclassement = new SaisieDeclassement();

        $prefablocSaisieDeclassementForm = $this->createForm( SaisieDeclassementType::class , $prefablocSaisieDeclassement );
        $prefablocSaisieDeclassementForm->handleRequest($request);

        if ( $prefablocSaisieDeclassementForm->isSubmitted() && $prefablocSaisieDeclassementForm->isValid() ) {
            $entityManager->persist($prefablocSaisieDeclassement);
            $entityManager->flush();

            $this->addFlash('success' , "Saisie du déclassement enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_saisie_declassement');
        } else {
            return $this->render('prefabloc/SaisieDeclassement.html.twig', [ 'prefablocSaisieDeclassementForm' => $prefablocSaisieDeclassementForm->createView()]);
        }
    }

    #[Route('/prefabloc/saisie/production' , name : 'app_prefacbloc_saisie_production')]
    public function prefablocSaisieProduction(Request $request , EntityManagerInterface $entityManager ) : Response
    {
        $prefablocSaisieProduction = new SaisieProduction();

        $prefablocSaisieProductionForm = $this->createForm( SaisieProductionType::class , $prefablocSaisieProduction ) ;
        $prefablocSaisieProductionForm->handleRequest($request);

        if ( $prefablocSaisieProductionForm->isSubmitted() && $prefablocSaisieProductionForm->isValid() ) {
            $entityManager->persist($prefablocSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success' , "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_saisie_production');
        } else {
            return $this->render('prefabloc/SaisieProduction.html.twig', [ 'prefablocSaisieProductionForm' => $prefablocSaisieProductionForm->createView()]);
        }
    }

    #[Route('/prefabloc/repartition/palette' , name : 'app_prefacbloc_repartition_palette')]
    public function prefablocRepartitionPalette(Request $request , EntityManagerInterface $entityManager ) : Response
    {
        $prefablocRepartitionPalette = new RepartitionPalette();
        $prefablocRepartitionPaletteForm = $this->createForm( RepartitionPaletteType::class , $prefablocRepartitionPalette ) ;
        $prefablocRepartitionPaletteForm->handleRequest($request);

        if ( $prefablocRepartitionPaletteForm->isSubmitted() && $prefablocRepartitionPaletteForm->isValid() ) {
            $entityManager->persist($prefablocRepartitionPalette);
            $entityManager->flush();

            $this->addFlash('success' , "Saisie de la répartition palette enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_repartition_palette');
        } else {
            return $this->render('prefabloc/RepartitionPalette.html.twig', [ 'prefablocRepartitionPaletteForm' => $prefablocRepartitionPaletteForm->createView()]);
        }
    }
}
