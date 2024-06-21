<?php

namespace App\Controller;

use App\Entity\ConsommationEssence;
use App\Form\ConsommationEssenceType;
use App\Repository\ConsommationEssenceRepository;
use App\Repository\IdentificationPrestationRepository;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ConsommationEssenceController extends AbstractController
{
    #[Route('/consommation/essence', name: 'app_consommation_essence')]
    public function ConsommationEssenceForm(
        Request $request,
        EntityManagerInterface $entityManager,
        MachineRepository $machineRepository,
        ConsommationEssenceRepository $consommationEssenceRepository

    ): Response {
        date_default_timezone_set('Indian/Reunion');

        $idMachine = $request->query->get('engin');
        $machine = $machineRepository->findOneBy(['id' => $idMachine]);

        $consoFromDb = $consommationEssenceRepository->getLastElement($machine);

        // Vérifie que le dernier élément existe et qu'il n'est pas validé
        // Si le contraire, on crée une nouvelle entité
        if ($consoFromDb == null || $consoFromDb->isValidated()) {
            $conso = new ConsommationEssence();
            $conso->setMachine($machine);
            $conso->setUser($this->getUser());
            $conso->setQuantite(1); // Set la quantité à 1 car 0 impossible
            $conso->setCreatedAt(new \DateTimeImmutable('now'));
            $conso->setValidated(false);
            $entityManager->persist($conso);
            $entityManager->flush();
        } else {
            $conso = $consoFromDb;
        }

        $conso->setQuantite(0); // Reset la quantité pour le front ( si le front renvoie 0 il y aura une erreur)
        $image = $conso->getPhotoCompteurCarburant(); // On récupère la photo avant que le formulaire n'efface notre entité

        $consoForm = $this->createForm(
            ConsommationEssenceType::class,
            $conso,
            ['machine_label' => $machine->getLabel()]
        );

        $consoForm->handleRequest($request);

        if ($consoForm->isSubmitted() && $consoForm->isValid()) {

            $conso->setValidated(true);
            $conso->setPhotoCompteurCarburant($image); // set la photo
            $entityManager->persist($conso);
            $entityManager->flush();
            $this->addFlash('success', 'Saisie de la consommation enregistrée !');

            return $this->redirectToRoute('app_success');
        }

        return $this->render('consommation_essence/index.html.twig', [
            'label' => 'Consommation Carburant Machine',
            'consoForm' => $consoForm->createView(),
            "consoEssenceId" => $conso->getId() // afin de retrouver la session
        ]);
    }


    #[Route('/consommation/essence/upload_photo', name: 'app_consommation_essence_upload_photo')]
    public function uploadPicture(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $entityManager,
        ConsommationEssenceRepository $consommationEssenceRepository
    ): JsonResponse {

        $file = $request->files->get('photo') ?: $request->files->get('photo2');

        $idConsoEssence = $request->request->get('idConsoEssence');

        if ($file && $idConsoEssence) {
            $path = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'photosConsos' . DIRECTORY_SEPARATOR;
            $newFileName = $this->generateFileName($file, $slugger);

            if ($this->saveFile($file, $path, $newFileName) && $this->updateConsoEssencePhoto($idConsoEssence, $path, $newFileName, $consommationEssenceRepository, $entityManager)) {
                return new JsonResponse(['status' => 'success', 'filename' => $newFileName]);
            }

            return new JsonResponse(['status' => 'error', 'message' => 'could not upload file'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'error', 'message' => 'No file uploaded or missing idConsoEssence'], Response::HTTP_BAD_REQUEST);
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

    private function updateConsoEssencePhoto(int $idConso, string $path, string $fileName, ConsommationEssenceRepository $repository, EntityManagerInterface $entityManager): bool
    {
        $conso = $repository->find($idConso);
        if ($conso) {
            $fullPath = $path . $fileName; // Append filename to path
            $conso->setPhotoCompteurCarburant($fullPath);
            $entityManager->persist($conso);
            $entityManager->flush();
            return true;
        }
        return false;
    }
}
