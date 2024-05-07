<?php

namespace App\Controller;


use App\Entity\Valromex\ValromexSaisieDeclassement;
use App\Entity\Valromex\ValromexSaisieProduction;
use App\Form\BTP\BTPProductionType;
use App\Form\Valromex\ValromexSaisieDeclassementType;
use App\Form\Valromex\ValromexSaisieProductionType;
use App\Repository\BTP\BTPProductionRepository;
use App\Repository\Prefabloc\ProductionArticleRepository;
use App\Repository\Valromex\ValromexSaisieProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $btpvalromex = true ;

        $articles = $productionArticleRepository->findBySociete(2);

        $articleChoices = [];
        foreach ($articles as $article) {
            $articleChoices[$article->getReference() . " - " . $article->getLabel()] = $article->getReference();
        }

        $form = $this->createForm(BTPProductionType::class, $entity, [
            'disable_fields' => $entity !== null,
            'articles' => $articleChoices  // Pass articles as options to the form

        ]);

        $consommation = new ValromexSaisieProduction();
        $consommation->setBTPProduction($entity);

        $saisieForm = $this->createForm(ValromexSaisieProductionType::class, $consommation,[]);

        return $this->render('production/simple_select.html.twig', [
            'label' => "Production",
            "url" => $url,
            "form" => $form->createView(),
            "saisie" => $saisieForm->createView(),

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

    #[Route('/btpvalromex/saisie/declassement' , name : 'app_btpvalromex_saisie_declassement')]
    public function btpValromexSaisieDeclassement(Request $request , EntityManagerInterface $entityManager ) : Response
    {
        $valromexSaisieDeclassement = new ValromexSaisieDeclassement();
        $valromexSaisieDeclassementForm = $this->createForm( ValromexSaisieDeclassementType::class , $valromexSaisieDeclassement ) ;
        $valromexSaisieDeclassementForm->handleRequest($request);

        if ( $valromexSaisieDeclassementForm->isSubmitted() && $valromexSaisieDeclassementForm->isValid() ) {
            $entityManager->persist($valromexSaisieDeclassement);
            $entityManager->flush();

            $this->addFlash('success' , "Saisie du déclassement enregistrée !");
            return $this->redirectToRoute('app_btpvalromex_saisie_declassement');
        } else {
            return $this->render('btp_valromex/SaisieDeclassement.html.twig', [ 'valromexSaisieDeclassementForm' => $valromexSaisieDeclassementForm->createView()]);
        }
    }

    #[Route('/btpvalromex/production/saisie/{id}' , name : 'app_btpvalromex_production_saisie')]
    public function btpValromexProductionSaisie( Request $request , EntityManagerInterface $entityManager , ValromexSaisieProductionRepository $valromexSaisieProductionRepository, string $id ) : Response {

        dd($request);
    }









    #[Route('/btpvalromex/saisie/production' , name : 'app_btpvalromex_saisie_production')]
    public function btpValromexSaisieProduction(Request $request , EntityManagerInterface $entityManager ) : Response
    {
        $valromexSaisieProduction = new ValromexSaisieProduction();
        $valromexSaisieProductionForm = $this->createForm( ValromexSaisieProductionType::class , $valromexSaisieProduction ) ;
        $valromexSaisieProductionForm->handleRequest($request);

        if ( $valromexSaisieProductionForm->isSubmitted() && $valromexSaisieProductionForm->isValid() ) {
            $entityManager->persist($valromexSaisieProduction);
            $entityManager->flush();

            $this->addFlash('success' , "Saisie de la production enregistrée !");
            return $this->redirectToRoute('app_prefacbloc_saisie_production');
        } else {
            return $this->render('btp_valromex/SaisieProduction.html.twig', [ 'valromexSaisieProductionForm' => $valromexSaisieProductionForm->createView()]);
        }
    }
}
