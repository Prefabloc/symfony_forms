<?php

namespace App\Controller;

use App\Form\Exforman\ExformanProductionAlimentationType;
use App\Repository\Exforman\ExformanProductionAlimentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExformanController extends AbstractController
{
    // #[Route('/exforman', name: 'app_exforman')]
    // public function index(): Response
    // {
    //     return $this->render('exforman/index.html.twig', [
    //         'controller_name' => 'ExformanController',
    //     ]);
    // }

    #[Route('/exforman/production', name: 'app_exforman')]
    public function production(Request $request, ExformanProductionAlimentationRepository $repository): Response
    {
        $url = $request->getUri();
        $entity = $repository->findLastActive();

        $form = $this->createForm(ExformanProductionAlimentationType::class, $entity, [
            'disable_fields' => $entity !== null
        ]);

        return $this->render('production/simple_select.html.twig', [
            'label' => "Prefabloc Production",
            "url" => $url,
            "form" => $form->createView(),
        ]);
    }


    #[Route('/exforman/production/end', name: 'app_exforman_end', methods: ['POST'])]
    public function end(Request $request, ExformanProductionAlimentationRepository $repository): Response
    {
        $id = $request->query->get('id');

        $repository->endProduction($id);

        return $this->redirectToRoute('app_exforman');
    }

    #[Route('/exforman/production/start', name: 'app_exforman_start', methods: ['POST'])]
    public function start(Request $request, ExformanProductionAlimentationRepository $repository): Response
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
        return $this->redirectToRoute('app_exforman');
    }
}
