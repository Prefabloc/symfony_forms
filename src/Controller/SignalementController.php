<?php

namespace App\Controller;

use App\Entity\Signalement;
use App\Form\SignalementType;
use App\Repository\ProductionFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignalementController extends AbstractController
{
    #[Route('/signalement', name: 'app_signalement')]
    public function index(Request $request, EntityManagerInterface $entityManager, ProductionFormRepository $repository): Response
    {
        $url = $request->getUri();
        $signalement = new Signalement();

        $data = $request->request->all();
        $productionForm = $repository->findLastActiveByType($data['productionType']);

        $signalement->setProductionForm($productionForm);
        $signalement->setMessage($data['message']);
        $signalement->setType($data['type']);

        $entityManager->persist($signalement);
        $entityManager->flush();
        $this->addFlash('succes', "Saisie du signalement enregistré !");
        return $this->json("success");
    }
}
