<?php

namespace App\Controller;

use App\Entity\BTP\BTPProduction;
use App\Entity\Prefabloc\PrefablocProduction;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsommableController extends AbstractController
{
    #[Route('/consommable', name: 'app_consommable')]
    public function index(EntityManagerInterface $em, LoggerInterface $logger): Response
    {
        $productionBTP = $em->getRepository(BTPProduction::class)->findBy(['processedAt' => null]);
        $productionPFB = $em->getRepository(PrefablocProduction::class)->findBy(['processedAt' => null]);

        $consommableBTP = [];
        $consommablePFB = [];

        $saisieProductionIdsBTP = [];
        for ($i = 0; $i < count($productionBTP); $i++) {
            // append data
            $item = $productionBTP[$i]->getSaisieProduction();
            $saisieProductionIdsBTP[] = $item->getId();
            $consommableBTP[] = $item;
        }
        $saisieProductionIdsBTP = implode(",", $saisieProductionIdsBTP);

        $saisieProductionIdsPFB = [];
        for ($i = 0; $i < count($productionPFB); $i++) {
            // append data
            $item = $productionPFB[$i]->getSaisieProduction();
            $saisieProductionIdsPFB[] = $item->getId();
            $consommablePFB[] = $item;
        }
        $saisieProductionIdsPFB = implode(',', $saisieProductionIdsPFB);


        foreach ($productionBTP as $item) {
            $item->setProcessedAt(new \DateTime());
            $em->persist($item);
        }

        foreach ($productionPFB as $item) {
            $item->setProcessedAt(new \DateTime());
            $em->persist($item);
        }

        $logger->info("BTP Ids : $saisieProductionIdsBTP\n PFB Ids : $saisieProductionIdsPFB");
        $logger->error('An error occurred');

        $em->flush();

        return $this->json([
            "BTP" => $consommableBTP,
            "PFB" => $consommablePFB,
        ], 200, [], [
            "groups" => ["consommable"]
        ]);
    }
}
