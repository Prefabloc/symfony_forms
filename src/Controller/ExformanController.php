<?php

namespace App\Controller;

use App\Entity\Exforman\SaisieAlimentation;
use App\Entity\Exforman\SaisieDebit;
use App\Entity\Exforman\SaisieDestockage;
use App\Form\Exforman\ExformanProductionAlimentationType;
use App\Form\Exforman\SaisieAlimentationType;
use App\Form\Exforman\SaisieDebitType;
use App\Form\Exforman\SaisieDestockageType;
use App\Repository\ArticleRepository;
use App\Repository\Exforman\ExformanProductionAlimentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use FontLib\Table\Type\name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/exforman' , name: 'app_exforman_')]
class ExformanController extends AbstractController
{
    // #[Route('/exforman', name: 'app_exforman')]
    // public function index(): Response
    // {
    //     return $this->render('exforman/index.html.twig', [
    //         'controller_name' => 'ExformanController',
    //     ]);
    // }

    #[Route('/production', name: 'production')]
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


    #[Route('/production/end', name: 'production_end', methods: ['POST'])]
    public function end(Request $request, ExformanProductionAlimentationRepository $repository): Response
    {
        $id = $request->query->get('id');

        $repository->endProduction($id);

        return $this->redirectToRoute('app_exforman');
    }

    #[Route('/production/start', name: 'production_start', methods: ['POST'])]
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

    #[Route('/saisie/alimentation' , name : 'saisie_alimentation')]
    public function exformanSaisieAlimentation(Request $request , EntityManagerInterface $entityManager ) : Response
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

    #[Route('/saisie/debit' , name : 'saisie_debit')]
    public function exformanSaisieDebit() : Response
    {
        $exformanSaisieDebit = new SaisieDebit();
        $exformanSaisieDebitForm = $this->createForm( SaisieDebitType::class , $exformanSaisieDebit ) ;

        return $this->render('exforman/SaisieDebit.html.twig', [
            'exformanSaisieDebitForm' => $exformanSaisieDebitForm->createView()
        ]);
    }

    #[Route('/saisie/debit/validate' , name: 'saisie_declassement_validate')]
    public function prefablocSaisieDeclassementValidate( Request $request , EntityManagerInterface $entityManager , ArticleRepository $articleRepository )
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent, true);

        $articleId = $data['idArticle'] ?? null;
        $article = $articleRepository->find($articleId);

        $quantite = $data['qte'] ?? null;

        $exformanSaisieDebit = new SaisieDebit();
        $exformanSaisieDebit
            ->setArticle($article)
            ->setQuantite($quantite);

        $entityManager->persist($exformanSaisieDebit);
        $entityManager->flush();

        $this->addFlash('success' , 'Saisie Débit réussie.');
        return $this->redirectToRoute('app_exforman_saisie_debit');
    }



    #[Route('/saisie/destockage' , name : 'saisie_destockage')]
    public function exformanSaisieDestockage() : Response
    {
        $exformanSaisieDestockage = new SaisieDestockage();
        $exformanSaisieDestockageForm = $this->createForm(SaisieDestockageType::class, $exformanSaisieDestockage);

        return $this->render('exforman/SaisieDestockage.html.twig', ['exformanSaisieDestockageForm' => $exformanSaisieDestockageForm->createView()]);

    }

    #[Route('/saisie/destockage/validate' , name : 'saisie_destockage_validate')]
    public function exformanSaisieDestockageValidate( Request $request , EntityManagerInterface $entityManager , ArticleRepository $articleRepository )
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent, true);

        $articleId = $data['idArticle'] ?? null;
        $article = $articleRepository->find($articleId);

        $quantite = $data['qte'] ?? null;

        $exformanSaisieDestock = new SaisieDebit();
        $exformanSaisieDestock
            ->setArticle($article)
            ->setQuantite($quantite);

        $entityManager->persist($exformanSaisieDestock);
        $entityManager->flush();

        $this->addFlash('success' , 'Saisie Destockage réussie.');
        return $this->redirectToRoute('app_exforman_saisie_destockage');

    }
}
