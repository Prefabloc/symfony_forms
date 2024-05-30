<?php

namespace App\Controller;

use App\Entity\Pointage;
use App\Form\PointageType;
use App\Repository\PointageRepository;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use FontLib\Table\Type\name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/pointage', name: 'app_pointage_')]
class PointageController extends AbstractController
{
    #[Route('/edit/{site}' , name: 'edit')]
    public function createPointage( SiteRepository $siteRepository, PointageRepository $pointageRepository , EntityManagerInterface $manager , string $site ): Response
    {

        date_default_timezone_set('Europe/Paris');
       $pointage = $pointageRepository->findLastActive();
       $siteTravail = $siteRepository->findByLabel($site);
       $user = $this->getUser();

       $heureArrivee = new \DateTime();

        if ( $pointage === null ){
           $pointage = new Pointage();
           $pointage
               ->setSite($siteTravail)
               ->setArrivedAt($heureArrivee)
               ->setEmploye($user);

           $manager->persist($pointage);
           $manager->flush();
       }

       return $this->render( 'pointage/pointage.html.twig' , [
           'site' => $siteTravail,
           'pointage' => $pointage
       ]);
    }

    #[Route('/validate/{id}' , name: 'validate')]
    public function validatePointage( $id , PointageRepository $pointageRepository , EntityManagerInterface $manager  )
    {
        date_default_timezone_set('Europe/Paris');
        $pointage = $pointageRepository->find($id);
        $heureDepart = new \DateTime();
        $pointage->setDepartedAt($heureDepart);

        $manager->persist($pointage);
        $manager->flush();

        $this->addFlash('success' , 'Pointage de sortie enregistrée !');
        return $this->redirectToRoute('app_acceuil');
    }
}
