<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'display_navbar' => false
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {

    }

    #[Route('/autocomplete' , name: 'autocomplete')]
    public function autocomplete( UserRepository $repository , Request $request ): Response
    {
        $mot = $request->query->get('mot');

        if ( !$mot ) {
            return new JsonResponse([]);
        }

        $results = $repository->findByTerm($mot);

        $data = array_map( function ( $user ) {
            return new UserDTO( $user->getId() , $user->getSociete() , $user->getUsername() , $user->getPassword() , $user->getNom() , $user->getPrenom());
        } , $results );

        return new JsonResponse( $data );
    }
}
