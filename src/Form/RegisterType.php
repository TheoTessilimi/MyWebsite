<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'invalid_message' => 'Veuillez à bien remplir ce champ',
                'attr' => [
                    'placeholder' => 'Pseudo',
                    'class' => 'form-control',
                    'type' => 'text'
                ]])
            ->add('firstname', TextType::class, [
                'invalid_message' => 'Veuillez à bien remplir ce champ',
                'attr' => [
                    'placeholder' => 'Firstname',
                ]
            ])
            ->add('lastname', TextType::class, [
                'invalid_message' => 'Veuillez à bien remplir ce champ',
                'attr' => [
                    'placeholder' => 'Lastname'
                ]
            ])
            ->add('email', EmailType::class, [
                'invalid_message' => 'Veuillez à bien remplir ce champ',
                'attr' => [
                    'placeholder' => 'Your email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message'=> 'Le mot de passe et la confirmation doivent être identique',
                'label' => 'Mot de passe :',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe :',
                    'attr' => [
                        'placeholder' => 'Password'
                    ]
                ],
                'second_options' => [
                    'label' => 'Mot de passe :',
                    'attr' => [
                        'placeholder' => 'Confirm your password',
                        'class' => 'form-control'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr'=> [
                    'class' => 'btn btn-primary btn-block'
                ]

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
