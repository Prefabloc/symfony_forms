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
        $consommableBTP = $em->getRepository(BTPProduction::class)->findBy(['processedAt' => null]);
        $consommablePFB = $em->getRepository(PrefablocProduction::class)->findBy(['processedAt' => null]);

        $dataBTP = [];
        $dataPFB = [];

        $btpIds = [];
        for ($i = 0; $i < count($consommableBTP); $i++) {
            // append data
            $item = $consommableBTP[$i]->getSaisieProduction();
            $btpIds[] = $item->getId();
            $dataBTP[] = $item;
        }
        $btpIds = implode(",", $btpIds);

        $pfbIds = [];
        for ($i = 0; $i < count($consommablePFB); $i++) {
            // append data
            $item = $consommablePFB[$i]->getSaisieProduction();
            $pfbIds[] = $item->getId();
            $dataPFB[] = $item;
        }
        $pfbIds = implode(',', $pfbIds);


        foreach ($consommableBTP as $item) {
            $item->setProcessedAt(new \DateTime());
            $em->persist($item);
        }

        foreach ($consommablePFB as $item) {
            $item->setProcessedAt(new \DateTime());
            $em->persist($item);
        }

        $logger->info("BTP Ids : $btpIds\n PFB Ids : $pfbIds");
        $logger->error('An error occurred');

        $em->flush();

        return $this->json([
            "BTP" => $dataBTP,
            "PFB" => $dataPFB,
        ], 200, [], [
            "groups" => ["consommable"]
        ]);
    }
}
