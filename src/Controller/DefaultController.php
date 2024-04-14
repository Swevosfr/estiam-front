<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends AbstractController
{
    
    #[Route('/home', name: 'home_page')]
    public function homePage(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('Authentification\login.html.twig');
    }

    // Page d'inscription
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('Authentification\register.html.twig');
    }

    #[Route('/ajouter_mdp', name: 'ajouter_mdp')]
    public function AjouterMdp(): Response
    {
        return $this->render('ajouter_mdp.html.twig');
    }

}
