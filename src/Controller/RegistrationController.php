<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\AbonnementRepository;
use App\Security\EmailVerifier;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Controller\PaymentController;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register/{name}', name: 'app_register', methods:['GET', 'POST'])]
    public function register(
    Request $request, 
    AbonnementRepository $abonnementRepository,
    string $name,
    PaymentController $paymentController, 
    UserPasswordHasherInterface $userPasswordHasher
    ): Response
    {
        $user = new User();
        $abonnement = $abonnementRepository->findOneBy(['name' => $name]);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $session = $request->getSession();
            $session->set('user', $user);
            return $this->redirectToRoute('stripe_checkout', ['id' => $abonnement->getId()]);
            // encode the plain password
            // $user->setPassword(
            //     $userPasswordHasher->hashPassword(
            //         $user,
            //         $form->get('plainPassword')->getData()
            //     )
            // );

            // // $user->getAbonner()->setEmail($user->getEmail());
            // $user->getAbonner()->setSubscription($abonnement);
            // $entityManager->persist($user);
            // $entityManager->flush();

            // // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('accesgym@gmail.com', 'Accesgym Confirmation Mail'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );

            // // do anything else you need here, like send an email

            // return $security->login($user, LoginAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'abonnement'=>$abonnement,
        ]);
    }



    #[Route("/stripe-checkout/{id}", name:"stripe_checkout", methods: ['GET', 'POST'])]
    public function stripeCheckout(Abonnement $abonnement, Request $request)
    {

        $price = intval($abonnement->getTarif()) +0.99;
        $session = $request->getSession();
        
        $user = $session->get('user');
        
        // Configurez Stripe avec votre clé secrète
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        // URL de votre domaine (changez ceci selon votre environnement)
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

        // Créez une session de paiement Stripe
        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $abonnement->getName(),
                    ],
                    'unit_amount' => $price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'confirmation/' . $abonnement->getId(),
            'cancel_url' => $YOUR_DOMAIN . 'cancel',
             'automatic_tax' => [
                 'enabled' => true,
             ],
        ]);

        // Rediriger l'utilisateur vers l'URL de paiement Stripe
        return new RedirectResponse($checkout_session->url);

    
    }

    #[Route('/confirmation/{id}', name: 'app_confirmation')]
    function confirmation(Abonnement $abonnement, EntityManagerInterface $entityManager, Security $security, Request $request) {
        $session = $request->getSession();
        $user = $session->get('user');

            // $user->getAbonner()->setEmail($user->getEmail());
            $user->getAbonner()->setSubscription($abonnement);
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('accesgym@gmail.com', 'Accesgym Confirmation Mail'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // do anything else you need here, like send an email

         // return
          $security->login($user, LoginAuthenticator::class, 'main');

        return $this->render('registration/confirmation.html.twig', [
            
        ]);
    }

    #[Route('/cancel', name: 'app_cancel')]
    function cancel()
    {
        
        // créez une page qui indique que le paiement a été refusée
        return $this->render('registration/cancel.html.twig', [
            
        ]);
    }


    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
