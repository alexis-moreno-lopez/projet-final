<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoachController extends AbstractController
{
    #[Route('/coach', name: 'app_coach')]
    public function index(): Response

    {
        // faire ma conditons pour l'abonnements, récuperer l'utilisateur connecter $this->getUser()
        return $this->render('coach/coach.html.twig', [
            'controller_name' => 'CoachController',

        ]);
    }
}
