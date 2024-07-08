<?php


namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route("/stripe-checkout", name: "stripe_checkout", methods: ['GET', 'POST'])]
    public function stripeCheckout(Abonnement $abonnement, User $user)
    {

  
        $price = intval($abonnement->getTarif()) + 0.99;


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

//     #[Route('/confirmation/{id}', name: 'confirmation')]
// public function confirmation(Abonnement $abonnement): Response
// {
//     $this->updateApiRequest($order);
//     return $this->render('/stripe-checkout/{id}/confirmation.html.twig');
// }




//     #[Route('/cancel', name: 'cancel')]
// public function cancel():Response
// {
    
//     return $this->render('/stripe-checkout/{id}/cancel.html.twig');
// }

}

// $checkout_session = \Stripe\Checkout\Session::create([
//     'line_items' => [[
//         'id' => $id->getId(),
//         'tarif' => $tarif->getTarif(),
//         'name' => $name->getName(),
//       ]],
//     'mode' => 'subscription',
//     'success_url' => $YOUR_DOMAIN . '/success.html',
//     'cancel_url' => $YOUR_DOMAIN . '/cancel.html',

// ]);



// $YOUR_DOMAIN = 'http://localhost:4242';

// $checkout_session = \Stripe\Checkout\Session::create([
//   'line_items' => [[
//     # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
//     'price' => '{{PRICE_ID}}',
//     'quantity' => 1,
//   ]],
//   'mode' => 'payment',
