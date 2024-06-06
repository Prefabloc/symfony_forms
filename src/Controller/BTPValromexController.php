<?php

namespace App\Controller;


use App\Entity\BTP\BTPProduction;
use App\Entity\Valromex\ValromexSaisieDeclassement;
use App\Entity\Valromex\ValromexSaisieProduction;
use App\Form\BTP\BTPProductionType;
use App\Form\Valromex\ValromexSaisieDeclassementType;
use App\Form\Valromex\ValromexSaisieProductionType;
use App\Repository\BTP\BTPProductionRepository;
use App\Repository\MotifDeclassementRepository;
use App\Service\ArticleDTO;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/btpvalromex', name: 'app_btpvalromex_')]
class BTPValromexController extends AbstractController
{
    //     #[Route('/btpvalromex', name: 'app_btpvalromex')]
//     public function index(): Response
//     {
//         return $this->render('btp_valromex/index.html.twig', [
//             'controller_name' => 'BTPValromexController',
//         ]);
//     }

    #[Route('/production', name: 'production')]
    public function production(Request $request, BTPProductionRepository $repository): Response
    {
        $url = $request->getUri();
        $articleLabel = '';
        $entity = $repository->findLastActive();

        if ($entity != null) {
            $article = $entity->getArticle();
            $articleLabel = $article->getLabel();
        }

        $form = $this->createForm(BTPProductionType::class, $entity);

        return $this->render('btp_valromex/index.html.twig', [
            'label' => "BTPValromex Production",
            "url" => $url,
            "productionForm" => $form->createView(),
            "productionId" => $entity == null ? 0 : $entity->getId(),
            'articleLabel' => $articleLabel
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
            return new ArticleDTO($article->getId(), $article->getLabel(), $article->getReference(), $article->getSociete()->getLabel(), $article->getStock());
        }, $results);

        return new JsonResponse($data);
    }


    #[Route('/production/start', name: 'production_start', methods: ['POST'])]
    public function start(Request $request, ArticleRepository $repository, EntityManagerInterface $entityManager): Response
    {
        // Retrieve the raw JSON content from the request
        $jsonContent = $request->getContent();

        // Decode the JSON content to an associative array
        $data = json_decode($jsonContent, true);

        // Access the 'idArticle' variable from the decoded array
        $articleId = $data['idArticle'] ?? null;
        //Reconstruire l'article grâce à l'id récupérée et le lier à l'entité Production
        $article = $repository->find($articleId);

        $btpProduction = new BTPProduction();
        $btpProduction->setArticle($article);

        $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
        $startedAt = new \DateTime('now', $timezone);
        $btpProduction->setStartedAt($startedAt);

        $entityManager->persist($btpProduction);
        $entityManager->flush();

        return $this->redirectToRoute('app_btpvalromex_production');
    }

    #[Route('/saisie/declassement', name: 'saisie_declassement')]
    public function btpValromexSaisieDeclassement(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response
    {
        $valromexSaisieDeclassement = new ValromexSaisieDeclassement();
        $valromexSaisieDeclassementForm = $this->createForm(ValromexSaisieDeclassementType::class, $valromexSaisieDeclassement);

        /*
        $formData = $valromexSaisieDeclassementForm->getData();
        $labelArticle = $formData->getArticle() ;
        dd($formData);
        $article = $articleRepository->findOneBy(['label' => $labelArticle]);
        $valromexSaisieDeclassement->setArticle($article);

        $entityManager->persist($valromexSaisieDeclassement);
        $entityManager->flush();
        */

        return $this->render('btp_valromex/SaisieDeclassement.html.twig' , [
            'valromexSaisieDeclassementForm' => $valromexSaisieDeclassementForm
        ] );
    }

    #[Route('/saisie/declassement/validate' , name: 'saisie_declassement_validate')]
    public function btpValromexSaisieDeclassementValidate( Request $request , EntityManagerInterface $entityManager , ArticleRepository $articleRepository , MotifDeclassementRepository $motifDeclassementRepository )
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent , true );

        $articleId = $data['idArticle'] ?? null ;
        $article = $articleRepository->find($articleId);

        $motifDeclassementId = $data['idMotif'] ?? null ;
        $motifDeclassement = $motifDeclassementRepository->find($motifDeclassementId);

        $quantite = $data['qte'] ?? null ;

        $valromexSaisieDeclassement = new ValromexSaisieDeclassement();
        $valromexSaisieDeclassement
            ->setArticle($article)
            ->setMotifDeclassement($motifDeclassement)
            ->setQuantite($quantite);

        $entityManager->persist($valromexSaisieDeclassement);
        $entityManager->flush();

        $this->addFlash('success' , 'Saisie Declassement réussie.');
        return $this->redirectToRoute('app_btpvalromex_saisie_declassement');
    }

    #[Route('/saisie/production', name: 'saisie_production')]
    public function btpValromexSaisieProduction(Request $request, EntityManagerInterface $entityManager, BTPProductionRepository $repository): Response
    {
        $valromexSaisieProduction = new ValromexSaisieProduction();

        $id = $request->query->get('id');
        $production = $repository->find($id);

        if (!$production) {
            return $this->redirectToRoute('app_btpvalromex_production');
        }

        $valromexSaisieProduction->setBTPProduction($production);
        $valromexSaisieProductionForm = $this->createForm(ValromexSaisieProductionType::class, $valromexSaisieProduction);
        $valromexSaisieProductionForm->handleRequest($request);

        if ($valromexSaisieProductionForm->isSubmitted() && $valromexSaisieProductionForm->isValid()) {
            $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
            $endedAt = new \DateTime('now', $timezone);
            $production->setEndedAt($endedAt);

            $entityManager->persist($production);
            $entityManager->persist($valromexSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success', "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_btpvalromex_production');
        } else {
            return $this->render('btp_valromex/SaisieProduction.html.twig', ['valromexSaisieProductionForm' => $valromexSaisieProductionForm->createView()]);
        }
    }
}
