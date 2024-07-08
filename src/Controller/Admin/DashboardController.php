<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use App\Entity\Abonner;
use App\Entity\Appointment;
use App\Entity\Coach;
use App\Entity\Paiement;
use App\Entity\Recette;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('acces gym');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Abonnement', 'fa-solid fa-scroll' , Abonnement::class);
        yield MenuItem::linkToCrud('Abonner', 'fa-solid fa-folder-open', Abonner::class);
        yield MenuItem::linkToCrud('Paiement', 'fa-solid fa-credit-card',Paiement::class);
        yield MenuItem::linkToCrud('Recette', 'fa-solid fa-lemon',Recette::class);
        yield MenuItem::linkToCrud('User', 'fa-solid fa-circle-user',User::class);
    }
}
