<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Abonner;
use App\Form\AbonnerType;
use App\Form\EditProfilType;
use App\Form\RegistrationFormType;
use App\Repository\AbonnerRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class EditController extends AbstractController
{
    #[Route('/edit', name: 'app_edit')]
    public function edit(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }


        /**
         * @var User $user
         */
        if(!$user->getAbonner()) {
            return $this->redirectToRoute('app_abonnement');
        }
    

        $form = $this->createForm(EditProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour avec succès.');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('Edit/edit.html.twig', [
            'form' => $form->createView(),
            'abonner' => $user,
        ]);
    }
}