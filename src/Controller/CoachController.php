<?php




namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class CoachController extends AbstractController
{
    #[Route('/coach', name: 'app_coach')]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérer tous les utilisateurs avec le rôle de coach
        $usersWithRoleCoach = $userRepository->findUsersByRole('ROLE_COACH');

        return $this->render('coach/coach.html.twig', [
            'coaches' => $usersWithRoleCoach,
        ]);
    }
}