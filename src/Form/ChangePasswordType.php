<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Mon adresse email'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Mon prénom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,//je souhaite pasque l'utilisateur modifie son nom
                'label' => 'Mon nom'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mon mot de passe actuel',//ne pas lier le champs a mon entité
                'mapped' => false,
                'attr' => [
                    'placeholder' => ' Saisie votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,//ne pas lié mon champs a mon entité
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Nouveau mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => ' Nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'saisie votre nouveau mot de passe.'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'confirmez votre nouveau mot de passe.' 
                    ]
                ]
               
            ])
            ->add('submit',SubmitType::class, [
                'label' => "Mettre à jour"
            ])

         ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}