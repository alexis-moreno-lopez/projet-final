<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password')
                ->setFormType(PasswordType::class)
                ->onlyWhenCreating(), // Pour afficher ce champ uniquement lors de la création d'un utilisateur
            ChoiceField::new('roles')->setChoices([
                'Utilisateur' => 'ROLE_USER',
                'Coach' => 'ROLE_COACH',
                'Administrateur' => 'ROLE_ADMIN',
            ])->allowMultipleChoices(),
            BooleanField::new('isVerified'),
        ];
    }
}