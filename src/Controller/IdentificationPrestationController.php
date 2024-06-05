<?php

namespace App\Controller;

use App\Entity\IdentificationPrestation;
use App\Form\IdentificationPrestationType;
use App\Repository\IdentificationPrestationRepository;
use App\Service\YouSignService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/identification_prestation', name: 'app_identification_prestation_')]
class IdentificationPrestationController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function identificationPrestationForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        date_default_timezone_set('Europe/Paris');
        $identificationPrestation = new IdentificationPrestation();

        $dateTimeArrivee = new \DateTime();
        $identificationPrestation->setHeureArrivee($dateTimeArrivee);

        $identificationPrestationForm = $this->createForm(IdentificationPrestationType::class, $identificationPrestation);
        $identificationPrestationForm->handleRequest($request);

        if ($identificationPrestationForm->isSubmitted() && $identificationPrestationForm->isValid()) {

            $entityManager->persist($identificationPrestation);
            $entityManager->flush();

            $this->addFlash('success', 'Formulaire identification rempli.');
            return $this->redirectToRoute('app_identification_prestation_forms');
        } else {
            return $this->render('identification_prestation/identificationPrestation.html.twig', ['identificationPrestationForm' => $identificationPrestationForm->createView()]);
        }
    }

    #[Route('/forms', name: 'forms')]
    public function showForms(IdentificationPrestationRepository $identificationPrestationRepository): Response
    {

        $formulairesIdentificationPrestation = $identificationPrestationRepository->findAll();

        return $this->render('identification_prestation/formulaires.html.twig', [
            'formulairesIdentificationPrestation' => $formulairesIdentificationPrestation
        ]);
    }

    #[Route('validate/{id}', name: 'validate')]
    public function validateForm(Request $request, EntityManagerInterface $entityManager, IdentificationPrestationRepository $identificationPrestationRepository, int $id): Response
    {

        $identificationPrestation = $identificationPrestationRepository->find($id);
        $identificationPrestationForm = $this->createForm(IdentificationPrestationType::class, $identificationPrestation);
        $identificationPrestationForm->handleRequest($request);

        if ($identificationPrestationForm->isSubmitted() && $identificationPrestationForm->isValid()) {
            $societe = $identificationPrestationForm->get('societe')->getData();
            $nomPrenom = $identificationPrestationForm->get('nomPrenom')->getData();
            $prestation = $identificationPrestationForm->get('prestation')->getData();
            $commanditaire = $identificationPrestationForm->get('commanditaire')->getData();

            $identificationPrestation->setSociete($societe);
            $identificationPrestation->setNomPrenom($nomPrenom);
            $identificationPrestation->setPrestation($prestation);
            $identificationPrestation->setCommanditaire($commanditaire);

            $dateTimeDepart = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $identificationPrestation->setHeureDepart($dateTimeDepart);

            $entityManager->persist($identificationPrestation);
            $entityManager->flush();

            $this->addFlash('succes', 'Formulaire clos');
            return $this->redirectToRoute('app_identification_prestation_forms');
        }

        return $this->render('identification_prestation/editForm.html.twig', [
            'identificationPrestationForm' => $identificationPrestationForm,
            'identificationPrestation' => $identificationPrestation
        ]);
    }

    #[Route('/pdf/{id}', name: 'pdf')]
    public function pdf(int $id, IdentificationPrestationRepository $identificationPrestationRepository, EntityManagerInterface $entityManager, Request $request): Response
    {

        $identificationPrestation = $identificationPrestationRepository->find($id);

        $dompdf = new Dompdf();

        $html = $this->renderView('identification_prestation/pdf.html.twig', [
            'identificationPrestation' => $identificationPrestation
        ]);

        //On file le fichier qu'on veut mettre en pdf à dompdf
        $dompdf->loadHtml($html);
        //Précision du format
        $dompdf->setPaper('A4', 'Portrait');
        //Rendu
        $dompdf->render();
        //Récupération du pdf
        $output = $dompdf->output();
        //On détermine le nom du pdf
        $filename = 'identification_prestation_' . $identificationPrestation->getId() . '_' . $identificationPrestation->getSociete() . '.pdf';
        //On détermine l'endroit où le projet est en train d'être écrit
        $file = $this->getParameter('kernel.project_dir') . '/public/PDFs/' . $filename;

        $identificationPrestation->setPdfSansSignature($filename);
        $entityManager->persist($identificationPrestation);
        $entityManager->flush();

        //Enregistrement du fichier
        file_put_contents($file, $output);

        return $this->redirectToRoute('app_identification_prestation_forms');
    }

    // #[Route('/sign/{id}' , name : 'sign')]
    // public function signature( EntityManagerInterface $entityManager , YouSignService $youSignService , IdentificationPrestationRepository $identificationPrestationRepository , int $id ) : Response {

    //     //Création de la demande de signature
    //     $identificationPrestation = $identificationPrestationRepository->find($id);
    //     $youSignSignatureRequest = $youSignService->signatureRequest();
    //     $identificationPrestation->setSignatureId($youSignSignatureRequest['id']);
    //     $entityManager->persist($identificationPrestation);

    //     //Upload du document
    //     $uploadDocument = $youSignService->uploadDocument($identificationPrestation->getSignatureId() , $identificationPrestation->getPdfSansSignature());
    //     $identificationPrestation->setDocumentId($uploadDocument['id']);
    //     $entityManager->persist($identificationPrestation);

    //     //Ajout des signataires
    //     $signerId = $youSignService->addSigner(
    //         $identificationPrestation->getSignatureId(),
    //         $identificationPrestation->getDocumentId(),
    //         'userEmailToSend@gmail.com',
    //         $identificationPrestation->getNomPrenom(),
    //         'TEST'
    //     );

    //     $identificationPrestation->setSignerId($signerId['id']);
    //     $entityManager->persist($identificationPrestation);
    //     $entityManager->flush();

    //     //Envoi de la demande de signature
    //     $youSignService->activateSignatureRequest($identificationPrestation->getSignatureId());

    //     return $this->redirectToRoute('app_identification_prestation_forms');

    // }

}
