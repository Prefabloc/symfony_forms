<?php

namespace App\Controller;

use App\Entity\Prefabloc\PrefablocSaisieProduction;
use App\Form\Prefabloc\PrefablocProductionType;
use App\Form\Prefabloc\PrefablocSaisieProductionType;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use App\Repository\Prefabloc\ProductionArticleRepository;
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


        $consommation = new PrefablocSaisieProduction();
        $consommation->setProduction($entity);

        $saisieForm = $this->createForm(PrefablocSaisieProductionType::class, $consommation, []);

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
}
