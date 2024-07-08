<?php

namespace App\Form;

use App\Entity\Coach;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('name')
            ->add('picture', FileType::class, [
                'label' => 'Image (JPEG, PNG)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/*'
                ],
            ])
            ->add('text')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Choisir un type' => '',
                    'Apéritif' => 'apéritif',
                    'Plat de résistance' => 'plat',
                    'Dessert' => 'dessert',
                ],
                'attr' => ['class' => 'form-control', 'required' => 'required'],
            ])
            ->add('summarize')
            ->add('time')
            ->add('ingredient')
            // ->add('coach', EntityType::class, [
            //     'class' => Coach::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
