<?php

namespace App\Controller;

use App\Form\BTP\BTPProductionType;
use App\Repository\BTP\BTPProductionRepository;
use App\Repository\ProductionArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BTPValromexController extends AbstractController
{
    //     #[Route('/btpvalromex', name: 'app_btpvalromex')]
//     public function index(): Response
//     {
//         return $this->render('btp_valromex/index.html.twig', [
//             'controller_name' => 'BTPValromexController',
//         ]);
//     }

    #[Route('/btpvalromex/production', name: 'app_btpvalromex')]
    public function production(Request $request, BTPProductionRepository $repository, ProductionArticleRepository $productionArticleRepository): Response
    {
        $url = $request->getUri();
        $entity = $repository->findLastActive();


        $articles = $productionArticleRepository->findBySociete(2);

        $articleChoices = [];
        foreach ($articles as $article) {
            $articleChoices[$article->getReference() . " - " . $article->getLabel()] = $article->getReference();
        }

        $form = $this->createForm(BTPProductionType::class, $entity, [
            'disable_fields' => $entity !== null,
            'articles' => $articleChoices  // Pass articles as options to the form

        ]);

        return $this->render('production/simple_select.html.twig', [
            'label' => "Prefabloc Production",
            "url" => $url,
            "form" => $form->createView(),
        ]);
    }


    #[Route('/btpvalromex/production/end', name: 'app_btpvalromex_end', methods: ['POST'])]
    public function end(Request $request, BTPProductionRepository $repository): Response
    {
        $id = $request->query->get('id');

        $repository->endProduction($id);

        return $this->redirectToRoute('app_btpvalromex');
    }

    #[Route('/btpvalromex/production/start', name: 'app_btpvalromex_start', methods: ['POST'])]
    public function start(Request $request, BTPProductionRepository $repository): Response
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
        return $this->redirectToRoute('app_btpvalromex');
    }
}
