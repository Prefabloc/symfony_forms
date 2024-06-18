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
    public function ConsommationEssenceForm(Request $request,
                                            EntityManagerInterface $entityManager,
                                            MachineRepository $machineRepository
    ): Response
    {
        date_default_timezone_set('Indian/Reunion');

        $idMachine = $request->query->get('engin');
        $machine = $machineRepository->findOneBy(['id' => $idMachine ]);

        $conso = new ConsommationEssence();
        $conso->setMachine($machine);
        $consoForm = $this->createForm(
            ConsommationEssenceType::class,
            $conso,
            [ 'machine_label' => $machine->getLabel() ]
        );
        $consoForm->handleRequest($request);

        if ($consoForm->isSubmitted() && $consoForm->isValid()) {
            $conso = $consoForm->getData();

            // Vérifiez si le champ createdAt est null et définissez-le à la date du jour
            if ($conso->getCreatedAt() === null) {
                $conso->setCreatedAt(new \DateTimeImmutable('now'));
            }

            $entityManager->persist($conso);
            $entityManager->flush();
            $this->addFlash('success', 'Saisie de la consommation enregistrée !');

            return $this->redirectToRoute('app_consommation_essence' , ['engin' => $idMachine]);
        }

        return $this->render('consommation_essence/index.html.twig', [
            'label' => 'Consommation Carburant Machine',
            'consoForm' => $consoForm->createView()
        ]);
    }


    #[Route('/consommation/essence/uploadPicture')]
    public function uploadPicture ( Request $request , SluggerInterface $slugger , EntityManagerInterface $entityManager , ConsommationEssenceRepository $consommationEssenceRepository )
    {
        $file = $request->files->get('photo') ;

        if ( $file ) {
            $path = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'photosConso' . DIRECTORY_SEPARATOR;
            $newFileName = $this->generateFileName($file, $slugger);

            if ( $this->saveFile( $file , $path , $newFileName )) {
                return new JsonResponse(['status' => 'success', 'filename' => $path . $newFileName]);
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


}
