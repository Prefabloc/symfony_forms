<?php

namespace App\Controller;

use App\Entity\HistoriqueActionsArticle;
use App\Entity\ProductionArticle;
use App\Repository\ProductionArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/historique_actions_article' , name: 'app_historique_actions_article')]
class HistoriqueActionsArticleController extends AbstractController
{
    #[Route('/createOnAdd', name: '_createAdd')]
    public function addHistorique( Request $request,  EntityManagerInterface $entityManager, ProductionArticleRepository $articleRepository  ): Response
    {
        $user = $this->getUser();

        $content = $request->getContent();
        $data = json_decode($content  , true ) ;

        $inputValue = $data['valeurInput'];

        $idArticle = $data['idArticle'];
        $article = $articleRepository->find($idArticle);

        $articleStock = $article->getStock();
        $article->setStock( $articleStock + $inputValue);
        $entityManager->persist($article);

        $historique = new HistoriqueActionsArticle();
        $historique->setQuantite($inputValue);
        $historique->setPersonneModifiant($user);
        $historique->setArticle($article);
        $entityManager->persist($historique);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success' ,  'message' => 'Ajout confirmé !']);
    }

    #[Route('/createOnRemove', name: '_createRemove')]
    public function removeHistorique( Request $request,  EntityManagerInterface $entityManager, ProductionArticleRepository $articleRepository  ): Response
    {
        $user = $this->getUser();

        $content = $request->getContent();
        $data = json_decode($content  , true ) ;

        $inputValue = $data['valeurInput'];

        $idArticle = $data['idArticle'];
        $article = $articleRepository->find($idArticle);

        $articleStock = $article->getStock();

        if ( $articleStock < $inputValue ) {
            return new JsonResponse(['status' => 'error' , 'message' => 'Stock insuffisant pour cette opération !'] , 400 );
        } else {
            $article->setStock( $articleStock - $inputValue);
            $entityManager->persist($article);

            $historique = new HistoriqueActionsArticle();
            $historique->setQuantite(-$inputValue);
            $historique->setPersonneModifiant($user);
            $historique->setArticle($article);
            $entityManager->persist($historique);
            $entityManager->flush();

            return new JsonResponse(['status' => 'success' ,  'message' => 'Retrait confirmé !']);
        }
    }
}
