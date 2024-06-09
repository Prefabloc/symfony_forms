<?php

namespace App\Controller;

use App\Entity\IdentificationPrestation;
use App\Form\IdentificationPrestationType;
use App\Repository\IdentificationPrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/identification_prestation', name: 'app_identification_prestation_')]
class IdentificationPrestationController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function identificationPrestationForm(Request $request, EntityManagerInterface $entityManager, IdentificationPrestationRepository $identificationPrestationRepository): Response
    {
        date_default_timezone_set('Indian/Reunion');
        $session = $request->getSession();


        if ($session->has('idIdentification')) {
            $idIdentification = $session->get('idIdentification');
            $identificationPrestation = $identificationPrestationRepository->find($idIdentification);

            if ($identificationPrestation->getHeureDepart() != null) {
                $session->clear();
                return $this->redirectToRoute('app_identification_prestation_create');
            } else {
                return $this->render('identification_prestation/identificationPrestation.html.twig', [
                    'identificationPrestation' => $identificationPrestation
                ]);
            }
        } else {
            $identificationPrestation = new IdentificationPrestation();

            $dateTimeArrivee = new \DateTime();
            $identificationPrestation->setHeureArrivee($dateTimeArrivee);

            $identificationPrestationForm = $this->createForm(IdentificationPrestationType::class, $identificationPrestation);
            $identificationPrestationForm->handleRequest($request);

            if ($identificationPrestationForm->isSubmitted() && $identificationPrestationForm->isValid()) {

                $entityManager->persist($identificationPrestation);
                $entityManager->flush();

                $idIP = $identificationPrestation->getId();
                $session->set('idIdentification', $idIP);

                $this->addFlash('success', 'Formulaire identification rempli. Signez en partant.');
                return $this->redirectToRoute('app_identification_prestation_create');
            } else {
                return $this->render('identification_prestation/identificationPrestation.html.twig', [
                    'identificationPrestationForm' => $identificationPrestationForm->createView(),
                ]);
            }
        }
    }

    // #[Route('/forms', name: 'forms')]
    // public function showForms(IdentificationPrestationRepository $identificationPrestationRepository): Response
    // {
    //     $formulairesIdentificationPrestation = $identificationPrestationRepository->findAll();

    //     return $this->render('identification_prestation/formulaires.html.twig', [
    //         'formulairesIdentificationPrestation' => $formulairesIdentificationPrestation
    //     ]);
    // }

    #[Route('/validate/{id}', name: 'validate')]
    public function validateForm(Request $request, EntityManagerInterface $entityManager, IdentificationPrestationRepository $identificationPrestationRepository, int $id): Response
    {
        date_default_timezone_set('Indian/Reunion');
        $session = $request->getSession();
        $referer = $request->headers->get('referer');
        $identificationPrestation = $identificationPrestationRepository->find($id);
        $identificationPrestation->setHeureDepart(new \DateTime());

        // if ($referer === "http://127.0.0.1:8000/identification_prestation/forms") {
        //     $session->clear();

        //     return $this->render('identification_prestation/identificationPrestation.html.twig', [
        //         'identificationPrestation' => $identificationPrestation
        //     ]);
        // } else {
        $entityManager->persist($identificationPrestation);
        $entityManager->flush();
        $session->clear();

        return $this->redirectToRoute('app_identification_prestation_create');
        // }
    }

    // #[Route('/pdf/{id}', name: 'pdf')]
    // public function pdf(int $id, IdentificationPrestationRepository $identificationPrestationRepository, EntityManagerInterface $entityManager, Request $request): Response
    // {

    //     $identificationPrestation = $identificationPrestationRepository->find($id);

    //     $dompdf = new Dompdf();

    //     $html = $this->renderView('identification_prestation/pdf.html.twig', [
    //         'identificationPrestation' => $identificationPrestation
    //     ]);

    //     //On file le fichier qu'on veut mettre en pdf à dompdf
    //     $dompdf->loadHtml($html);
    //     //Précision du format
    //     $dompdf->setPaper('A4', 'Portrait');
    //     //Rendu
    //     $dompdf->render();
    //     //Récupération du pdf
    //     $output = $dompdf->output();
    //     //On détermine le nom du pdf
    //     $filename = 'identification_prestation_' . $identificationPrestation->getId() . '_' . $identificationPrestation->getSociete() . '.pdf';
    //     //On détermine l'endroit où le projet est en train d'être écrit
    //     $file = $this->getParameter('kernel.project_dir') . '/public/PDFs/' . $filename;

    //     $identificationPrestation->setPdfSansSignature($filename);
    //     $entityManager->persist($identificationPrestation);
    //     $entityManager->flush();

    //     //Enregistrement du fichier
    //     file_put_contents($file, $output);

    //     return $this->redirectToRoute('app_identification_prestation_forms');
    // }

    #[Route('/sign', name: 'sign')]
    public function sign(Request $request, EntityManagerInterface $entityManager, IdentificationPrestationRepository $identificationPrestationRepository): Response
    {
        //On récupère le contenu du fetch
        $donnees = $request->getContent();
        //On décode le JSON
        $dataDecode = json_decode($donnees, false);

        //On s'occupe de récupérer l'identificationPrestation
        $idFormulaire = $dataDecode->idPrestation;
        $identificationPrestation = $identificationPrestationRepository->find($idFormulaire);

        //On explode une fois les data de l'image pour séparer le type de contenu du contenu
        list($type, $data) = explode(';', $dataDecode->image);

        //On explode une deuxième fois pour séparer le type de l'image de son nom en lui même
        list(, $img) = explode(',', $data);

        //On décode l'image et on génère son fichier
        $image_decodee = base64_decode($img);

        $path = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'signatures' . DIRECTORY_SEPARATOR;

        // Vérifie que le dossier existe bien
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        //On prévoit le nom du fichier en lui mettant un nom en série automatique et en rajoutant le format png
        $fichier = md5(uniqid()) . '.png';
        $finalPath = $path . $fichier;

        //On écrit le fichier dans le répértoire pour stocker
        file_put_contents($finalPath, $image_decodee);

        //On persist le chemin de l'image dans la bdd
        $identificationPrestation->setSignature($finalPath);
        $entityManager->persist($identificationPrestation);
        $entityManager->flush();

        return new JsonResponse([]);
    }

    #[Route('/upload_photo', name: 'upload_photo')]
    public function uploadPicture(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $entityManager,
        IdentificationPrestationRepository $identificationPrestationRepository
    ): JsonResponse {
        $file = $request->files->get('photo') ?: $request->files->get('photo2');
        $idPresta = $request->request->get('idPrestation');

        if ($file && $idPresta) {
            $path = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'photosBons' . DIRECTORY_SEPARATOR;
            $newFileName = $this->generateFileName($file, $slugger);

            if ($this->saveFile($file, $path, $newFileName) && $this->updatePrestaPhoto($idPresta, $path, $identificationPrestationRepository, $entityManager)) {
                return new JsonResponse(['status' => 'success', 'filename' => $newFileName]);
            }

            return new JsonResponse(['status' => 'error', 'message' => 'could not upload file'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'error', 'message' => 'No file uploaded or missing idPrestation'], Response::HTTP_BAD_REQUEST);
    }

    private function generateFileName($file, SluggerInterface $slugger): string
    {
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = $slugger->slug($originalFileName);
        return $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();
    }

    private function saveFile($file, string $path, string $fileName): bool
    {
        try {
            $file->move($path, $fileName);
            return true;
        } catch (FileException $e) {
            return false;
        }
    }

    private function updatePrestaPhoto(int $idPresta, string $path, IdentificationPrestationRepository $repository, EntityManagerInterface $entityManager): bool
    {
        $presta = $repository->find($idPresta);
        if ($presta) {
            $presta->setPhotoBonPrestation($path);
            $entityManager->persist($presta);
            $entityManager->flush();
            return true;
        }
        return false;
    }
}
