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
        // Récupère les données de productions
        // Map la base de donnée avec les references articles
        // Set la production en état "traité"
        // Log des ids de saisie
        // Save des données dans la base de données
        // Envoie des données
        $productionPFB = $em->getRepository(PrefablocProduction::class)->findBy(['processedAt' => null]);
        $productionBTP = $em->getRepository(BTPProduction::class)->findBy(['processedAt' => null]);

        $consommablePFB = [];
        $consommableBTP = [];

        $saisieProductionIdsPFB = [];
        for ($i = 0; $i < count($productionPFB); $i++) {
            // Format poutrelle
            $item = $productionPFB[$i]->getSaisieProduction();
            $saisieProductionIdsPFB[] = $item->getId();
            $formattedData = [
                formatItem("A073MP", $item->getQte04(), "remove"),
                formatItem("A082MP", $item->getQte610(), "remove"),
                formatItem("CIMENTPOUTRELLE", $item->getQteCEM(), "remove"),
                formatItem("ADJUVANT1", $item->getQteAdjuvant(), "remove"),
                formatItem("HUILEDEDECOFFRAG", $item->getQteHuile(), "remove"),
                formatItem("EAU", $item->getQteEau(), "remove"),
                formatItem($productionBTP[$i]->getMode(), $item->getQteAdjuvant(), "add"),
            ];
            $consommablePFB = array_merge($consommablePFB, $formattedData);

        }

        $saisieProductionIdsBTP = [];
        for ($i = 0; $i < count($productionBTP); $i++) {
            // append data
            $item = $productionBTP[$i]->getSaisieProduction();
            $saisieProductionIdsBTP[] = $item->getId();
            $formattedData = [
                formatItem("A073MP", $item->getQte04(), "remove"),
                formatItem("A082MP", $item->getQte610(), "remove"),
                formatItem("CIMENTPOUTRELLE", $item->getQteCEM(), "remove"),
                formatItem("ADJUVANT1", $item->getQteAdjuvant(), "remove"),
                formatItem("HUILEDEDECOFFRAG", $item->getQteHuile(), "remove"),
                formatItem("EAU", $item->getQteEau(), "remove"),
                formatItem($productionBTP[$i]->getMode(), $item->getQteAdjuvant(), "add"),
            ];
            $consommableBTP = array_merge($consommableBTP, $formattedData);
        }

        // foreach ($productionBTP as $item) {
        //     $item->setProcessedAt(new \DateTime("now", new \DateTimeZone('Europe/Moscow')));
        //     $em->persist($item);
        // }

        // foreach ($productionPFB as $item) {
        //     $item->setProcessedAt(new \DateTime("now", new \DateTimeZone('Europe/Moscow')));
        //     $em->persist($item);
        // }

        $saisieProductionIdsBTP = implode(",", $saisieProductionIdsBTP);
        $saisieProductionIdsPFB = implode(',', $saisieProductionIdsPFB);

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

function formatItem($reference, $quantite, $type)
{
    return [
        "reference" => $reference,
        "quantite" => $quantite,
        "type" => $type
    ];
}