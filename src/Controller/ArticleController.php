<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Service\ArticleDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/article', name: 'app_article_')]
class ArticleController extends AbstractController
{

    //Création d'une route qui va être appelée pour l'auto complete
    #[Route('/autocomplete', name: 'autocomplete')]
    public function autocomplete(ArticleRepository $articleRepository, Request $request): Response
    {
        //On récupère le mot entré dans le champ de recherche
        $mot = $request->query->get('mot');

        //Si pas de mot, on retourne une réponse Json vide
        if (!$mot) {
            return new JsonResponse([]);
        }

        //Sinon, on va chercher dans le repository des articles dont le label contient le mot
        $results = $articleRepository->findByTerm($mot, $this->getUser()->getSociete()->getId());
        //Pour éviter les soucis de conversion en JSON, on va passer par un service tiers développé au préalable qui reconstitue l'objet
        //Array_map applique une callback à chaque élément d'un tableau, donc ici chaque objet de results, donc chaque article, et va le reconstituer grâce à
        //l'objet créée dans le service 'ArticleDTO' ( Data Transfer Object )
        $data = array_map(function ($article) {
            return new ArticleDTO($article->getId(), $article->getLabel(), $article->getReference(), $article->getSociete()->getLabel(), $article->getStock() , $article->getTypeArticle());
        }, $results);

        //On renvoie la data transférée en JSON
        return new JsonResponse($data);
    }

    #[Route('/gestion_stock', name: 'gestion_stock')]
    public function gestionStock()
    {


        return $this->render('article/gestionStock.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
