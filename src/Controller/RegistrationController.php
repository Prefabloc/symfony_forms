<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\SocieteRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationController extends AbstractController
{
    #[Route('/admin/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager , ValidatorInterface $validator ): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() ) {

            $errors = $validator->validate($user);

            // encode the plain password
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );



            $societe = $form->get('societe')->getData();
            $societeNom = $societe->getLabel();

            $donneesForm = $request->request->all();
            $checkboxValueAccueil = $donneesForm['roleAccueil'] ?? null ;
            $checkboxValueEmploye = $donneesForm['roleEmploye'] ?? null ;


            if ( $checkboxValueAccueil === 'on' ) {
                $user->setRoles(["ROLE_ACCUEIL"]);
            } elseif ( $checkboxValueEmploye === 'on' ) {
                $user->setRoles(['ROLE_EMPLOYE']);
            } else {
                switch ( $societeNom ) {
                    case 'PREFABLOC' :
                        $user->setRoles(["ROLE_PREFABLOC"]);
                        break;

                    case 'PREFABLOC AGREGATS' :
                        $user->setRoles(["ROLE_AGREGAT"]);
                        break;

                    case 'EXFORMAN' :
                        $user->setRoles(["ROLE_EXFORMAN"]);
                        break;

                    case 'BTP-VALROMEX' :
                        $user->setRoles(["ROLE_BTPVALROMEX"]);
                        break;

                    default :
                        break;
                }
            }


            $user->setSociete($societe);

            if ( $form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();
            }





            // do anything else you need here, like send an email

            if(!$this->getUser()){
                return $security->login($user, AppAuthenticator::class, 'main');
            }else{
                return $this->redirectToRoute('app_acceuil');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
