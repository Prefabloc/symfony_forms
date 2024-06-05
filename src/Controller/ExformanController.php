<?php

namespace App\Controller;

use App\Entity\Exforman\SaisieAlimentation;
use App\Entity\Exforman\SaisieDebit;
use App\Entity\Exforman\SaisieDestockage;
use App\Form\Exforman\ExformanProductionAlimentationType;
use App\Form\Exforman\SaisieAlimentationType;
use App\Form\Exforman\SaisieDebitType;
use App\Form\Exforman\SaisieDestockageType;
use App\Repository\Exforman\ExformanProductionAlimentationRepository;
use Doctrine\ORM\EntityManagerInterface;
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
            "productionType" => "exforman"
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

    #[Route('/exforman/saisie/alimentation', name: 'app_exforman_saisie_alimentation')]
    public function exformanSaisieAlimentation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exformanSaisieAlimentation = new SaisieAlimentation();

        $exformanSaisieAlimentationForm = $this->createForm(SaisieAlimentationType::class, $exformanSaisieAlimentation);
        $exformanSaisieAlimentationForm->handleRequest($request);

        if ($exformanSaisieAlimentationForm->isSubmitted() && $exformanSaisieAlimentationForm->isValid()) {
            $entityManager->persist($exformanSaisieAlimentation);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de l'alimentation enregistrée !");
            return $this->redirectToRoute('app_exforman_saisie_alimentation');
        } else {
            return $this->render('exforman/SaisieAlimentation.html.twig', ['exformanSaisieAlimentationForm' => $exformanSaisieAlimentationForm->createView()]);
        }
    }

    #[Route('/exforman/saisie/debit', name: 'app_exforman_saisie_debit')]
    public function exformanSaisieDebit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exformanSaisieDebit = new SaisieDebit();

        $exformanSaisieDebitForm = $this->createForm(SaisieDebitType::class, $exformanSaisieDebit);
        $exformanSaisieDebitForm->handleRequest($request);

        if ($exformanSaisieDebitForm->isSubmitted() && $exformanSaisieDebitForm->isValid()) {
            $entityManager->persist($exformanSaisieDebit);
            $entityManager->flush();

            $this->addFlash('success', "Saisie du débit enregistrée !");
            return $this->redirectToRoute('app_exforman_saisie_debit');
        } else {
            return $this->render('exforman/SaisieDebit.html.twig', ['exformanSaisieDebitForm' => $exformanSaisieDebitForm->createView()]);
        }
    }

    #[Route('/exforman/saisie/destockage', name: 'app_exforman_saisie_destockage')]
    public function exformanSaisieDestockage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exformanSaisieDestockage = new SaisieDestockage();

        $exformanSaisieDestockageForm = $this->createForm(SaisieDestockageType::class, $exformanSaisieDestockage);
        $exformanSaisieDestockageForm->handleRequest($request);

        if ($exformanSaisieDestockageForm->isSubmitted() && $exformanSaisieDestockageForm->isValid()) {
            $entityManager->persist($exformanSaisieDestockage);
            $entityManager->flush();

            $this->addFlash('success', "Saisie du destockage enregistrée !");
            return $this->redirectToRoute('app_exforman_saisie_destockage');
        } else {
            return $this->render('exforman/SaisieDestockage.html.twig', ['exformanSaisieDestockageForm' => $exformanSaisieDestockageForm->createView()]);
        }
    }
}
