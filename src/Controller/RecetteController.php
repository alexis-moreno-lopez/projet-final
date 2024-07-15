<?php
// src/Controller/RecetteController.php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findAll();
        $aperitifs = $recetteRepository->findBy(['category' => 'aperitif']);
        $plats = $recetteRepository->findBy(['category' => 'plat']);
        $desserts = $recetteRepository->findBy(['category' => 'dessert']);

        return $this->render('Recette/recette.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes,
            'aperitifs' => $aperitifs,
            'plats' => $plats,
            'desserts' => $desserts,
        ]);
    }

    // #[Route('/recette', name: 'app_recette_new')]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $recette = new Recette();
    //     $form = $this->createForm(RecetteType::class, $recette);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $pictureFile = $form->get('picture')->getData();
    //         dd($pictureFile);
    //         if ($pictureFile) {
    //             $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
    //             $newFilename = uniqid() . '.' . $pictureFile->guessExtension();

    //             try {
    //                 $pictureFile->move(
    //                     $this->getParameter('pictures_directory'),
    //                     $newFilename
    //                 );
    //             } catch (FileException $e) {
    //                 // Handle exception if something happens during file upload
    //                 $this->addFlash('error', 'Failed to upload image.');
    //                 return $this->render('recette.html.twig', [
    //                     'form' => $form->createView(),
                        
    //                 ]);
    //             }

    //             $recette->setPicture($newFilename);
    //         } else {
    //             // Handle the case when no image is uploaded
    //             $this->addFlash('error', 'You must upload an image.');
    //             return $this->render('recette.html.twig', [
    //                 'form' => $form->createView(),
    //             ]);
    //         }

    //         $entityManager->persist($recette);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_recette');
    //     }

    //     return $this->render('recette.html.twig', [
    //         'form' => $form->createView(),
    //         'picture' => $pictureFile,
    //     ]);
    // }

    #[Route('/recette/delete/{id}', name: 'app_recette_delete')]
    function delete(Recette $recette, EntityManagerInterface $entityManager){
        $entityManager->remove($recette);
        $entityManager->flush();
        return $this->redirectToRoute('app_coach_profil');
    }
}
