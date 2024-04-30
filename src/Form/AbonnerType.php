<?php

namespace App\Form;

use App\Entity\Abonner;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('firstName')
            // ->add('email')
            ->add('gender'
            //   'required' => true,
            //   'data' => [
            //     'Homme' => 'Homme',
            //     'Femme' => 'Femme',
            //   ]
            )
            ->add('dateOfBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('telephone')
            ->add('postalCode')
            ->add('street')
            ->add('emailConfirmation')
            ->add('city')
            ->add('address')
            // ->add('subscription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonner::class,
        ]);
    }
}
