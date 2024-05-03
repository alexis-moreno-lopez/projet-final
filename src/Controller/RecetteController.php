<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findAll();
        // pour des categorie
        $aperitifs = $recetteRepository->findBy(['category' => 'aperitif']);
        $plats = $recetteRepository->findBy(['category' => 'plat']);
        $desserts = $recetteRepository->findBy(['category' => 'dessert']);

        return $this->render('Recette/recette.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes, // Transmettre l'identifiant de l'abonnement à la vue
            'aperitifs' => $aperitifs,
            'plats' => $plats,
            'desserts' => $desserts,
        ]);
    }
}