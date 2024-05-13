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


class RegistrationController extends AbstractController
{
    #[Route('/admin/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager , SocieteRepository $societeRepository): Response
    {
        $user = new User();
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
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
            $checkboxValue = $donneesForm['roleAccueil'] ?? null ;


            if ( $checkboxValue === 'on' && $checkboxValue != null ) {
                $user->setRoles(["ROLE_ACCUEIL"]);
            } else {
                switch ( $societeNom ) {
                    case 'PREFABLOC' :
                        $user->setRoles(["ROLE_PREFABLOC" , "ROLE_USER"]);
                        break;

                    case 'AGREGAT' :
                        $user->setRoles(["ROLE_AGREGAT" , "ROLE_USER"]);
                        break;

                    case 'EXFORMAN' :
                        $user->setRoles(["ROLE_EXFORMAN" , "ROLE_USER"]);
                        break;

                    case 'BTP-VALROMEX' :
                        $user->setRoles(["ROLE_BTPVALROMEX" , "ROLE_USER"]);
                        break;

                    default :
                        break;
                }
            }


            $user->setSociete($societe);
            $entityManager->persist($user);
            $entityManager->flush();

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
