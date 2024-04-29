<?php

namespace App\Controller\Admin;

use App\Entity\Abonner;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AbonnerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Abonner::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('firsName'),
            EmailField::new('email'),
            ChoiceField::new('gender'),
            DateField::new('dateOfBirth'),
            TelephoneField::new('telephone'),
            TextField::new('postalCode'),
            TextField::new('street'),
            TextField::new('emailConfirmation'),
            TextField::new('city'),
            TextField::new('adress'),
            TextField::new('subscribe'),
            AssociationField::new('user'),


        ];
    }
}
