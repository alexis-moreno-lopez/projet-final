<?php
namespace App\Controller;

use App\Repository\AbonnementRepository;
use App\Repository\AbonnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(AbonnementRepository  $abonnementRepository ): Response
    {
        // Vous pouvez également utiliser $id pour récupérer les détails de l'abonnement depuis la base de données si nécessaire
        $abonnements = $abonnementRepository->findAll();
        return $this->render('Abonnement/abonnement.html.twig', [
            'controller_name' => 'AbonnementController',
            'abonnements' => $abonnements, // Transmettre l'identifiant de l'abonnement à la vue
        ]);
    }
}