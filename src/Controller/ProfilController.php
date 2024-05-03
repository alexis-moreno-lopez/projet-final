<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Abonner;
use App\Form\AbonnerType;
use App\Repository\AbonnerRepository;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(AbonnerRepository $abonnerRepository): Response
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

        // Envoie les informations de l'abonné à la vue Twig
        return $this->render('profil/profil.html.twig', [
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
        ]);
    }

    

}