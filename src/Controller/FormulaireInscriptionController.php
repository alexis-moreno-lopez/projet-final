<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormulaireInscriptionController extends AbstractController
{
    #[Route('/formulaire/inscription', name: 'app_formulaire_inscription')]
    public function index(): Response
    {
        return $this->render('formulaire_inscription/formInscription.html.twig', [
            'controller_name' => 'FormulaireInscriptionController',
        ]);
    }
}
