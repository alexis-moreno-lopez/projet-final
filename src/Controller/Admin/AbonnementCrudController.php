<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AbonnementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Abonnement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('tarif'),
            // TextField::new('text'),
            TextField::new('textSchedule'),
            TextField::new('textActivity'),
            TextField::new('textRecipe'),
            TextField::new('textSpa'),
            TextField::new('textCoach'),
            TextField::new('title'),
            TextField::new('textDescription'),


        ];
    }
    
}
