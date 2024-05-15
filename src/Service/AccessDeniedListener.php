<?php

namespace App\Service;


use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\RouterInterface;


class AccessDeniedListener
{
    private $router;
    private $security;
    private $excludedRoutes = ['app_logout'] ;

    public function __construct( RouterInterface $router , Security $security )
    {
        $this->router = $router ;
        $this->security = $security ;

    }

    public function onKernelException( ExceptionEvent $event ) {

        $exception = $event->getThrowable();

        $request = $event->getRequest();
        $routeName = $request->attributes->get('_route');

        if ( in_array($routeName , $this->excludedRoutes )){
            return ;
        }

        if ( $exception instanceof AccessDeniedHttpException ) {
            $role = $this->security->getUser()->getRoles()[0];
            switch ( $role ) {
                case 'ROLE_ACCUEIL' :
                    $url = $this->router->generate('access_denied_accueil');
                    break;
                case 'ROLE_USER' :
                    $url = $this->router->generate('access_denied_user');
                    break;
                default :
                    $url = '/' ;
            }

                $response = new RedirectResponse($url);
                $event->setResponse($response);
        }
    }
}