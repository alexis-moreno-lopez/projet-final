<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/send_email', name: 'app_send_email')]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
        $email = $request->request->get('email'); // Récupérer l'adresse e-mail à partir du champ de formulaire
        $prenom = $request->request->get('prenom');
        $message = $request->request->get('message');
    
        if (empty($email)) {
            // Gérer le cas où l'adresse e-mail est manquante
            // Par exemple, rediriger l'utilisateur vers la page de formulaire avec un message d'erreur
            return $this->redirectToRoute('app_index', ['error' => 'Veuillez saisir une adresse e-mail valide.']);
        }
    
        $emailMessage = (new Email())
            ->from($email) // Utiliser l'adresse e-mail en tant qu'expéditeur
            ->to('destinataire@example.com')
            ->subject('Sujet du message')
            ->text("Prénom : $prenom\nMessage : $message");
    
        $mailer->send($emailMessage);
    
        return $this->redirectToRoute('app_index');
}



}