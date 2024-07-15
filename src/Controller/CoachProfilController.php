<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\AbonnerRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

// ICI autoriser que les coachs

class CoachProfilController extends AbstractController
{
    #[Route('/coachprofil', name: 'app_coach_profil')]
    public function index(Request $request, AbonnerRepository $abonnerRepository, EntityManagerInterface $entityManager, RecetteRepository $recetteRepository, SluggerInterface $slugger): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté
        $abonner = $abonnerRepository->findOneBy(['user' => $user]); // Récupère l'objet Abonner correspondant à l'utilisateur connecté
        $abonnerId = $abonner->getId(); // Récupère l'ID de l'abonner
        $abonnement = $abonner->getSubscription(); // Récupère l'objet Abonnement correspondant à l'abonné
        // Récupère les informations de l'abonné
        $nom = $abonner->getName();
        $prenom = $abonner->getFirstName();
        $dateNaissance = $abonner->getDateOfBirth()->format('d/m/Y');
        $telephone = $abonner->getTelephone();
        $email = $abonner->getEmailConfirmation();
        $codePostal = $abonner->getPostalCode();
        $ville = $abonner->getCity();
        $rue = $abonner->getStreet();
        $numeroRue = $abonner->getAddress();

        $imageUrl = $abonner->getProfileImageUrl();

        /**
         * @var User $user
         * retrouver toutes les recettes de l'utilisateur
         */
        $recettes = $recetteRepository->findBy(['user' => $user->getId()]);


        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $picture->guessExtension();

                try {
                    $picture->move($this->getParameter('pictures_directory'), $newFilename);
                } catch (FileException $e) {
                    // Throw Error image invalide 
                }

                $recette->setPicture($newFilename);

            }

            // foreach($pictures as $picture){
            //     $fichier = md5(uniqId()) . '.' . $picture->guessExtension();

            //     $picture->move(
            //         $this->getParameter('images_directory'),
            //         $fichier
            //     );



            // }
    
            /**
             * @var User $user
             */
            $recette->setUser($user);

    $entityManager->persist($recette);
    $entityManager->flush();


    return $this->redirectToRoute('app_coach_profil');
}
// if ($form->isSubmitted() && $form->isValid()) {
//     $recette->setUser($user);
// $entityManager->persist($recette);
//     // dd($recette);
//     $entityManager->flush();

//     $this->addFlash('success', 'reccete .');

//     return $this->redirectToRoute('app_coach_profil');
// }
        // Envoie les informations de l'abonné à la vue Twig
        return $this->render('coach_profil/coach_profil.html.twig', [
            'controller_name' => 'ProfilController',
            'abonnement' => $abonnement,
            'abonner' => $abonner,
            'abonnerId' => $abonnerId, // Passe l'ID de l'abonner à la vue Twig
            'nom' => $nom,
            'prenom' => $prenom,
            'dateNaissance' => $dateNaissance,
            'telephone' => $telephone,
            'emailConfirmation' => $email,
            'codePostal' => $codePostal,
            'ville' => $ville,
            'rue' => $rue,
            'numeroRue' => $numeroRue,
            'form' => $form->createView(),
            'recettes' => $recettes,
        ]);
    }


    
} 

