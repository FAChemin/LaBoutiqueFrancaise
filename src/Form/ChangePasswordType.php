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
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'disabled' => true,
                'label' => 'Votre adresse email',
            ])

            ->add('firstname', TextType::class,[
                'disabled' => true,
                'label' => 'Votre prénom',
            ])
            ->add('lastname', TextType::class,[
                'disabled' => true,
                'label' => 'Votre nom',
            ])

            ->add('old_password', PasswordType::class,[
                'label' => 'Mon mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Votre mot de passe actuel'
                ]
            ])

            ->add('new_password', RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'label' => 'Mot de passe',
                'required' => 'Ce champ est obligatoire',
                'invalid_message' => 'Le mot de passe actuel et le nouveau mot de passe doivent être identiques',


                'first_options' => [
                    'label' => 'Mon nouveau mot de passe',
                    'constraints' => new Length([
                        'min' => 5,
                        'max' => 60
                    ]),
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre nouveau mot de passe'
                    ]
                ],


                'second_options' => [
                    'label' => 'Confirmation',
                    'attr' => [
                        'placeholder' => 'Confirmez votre nouveau mot de passe mot de passe'
                    ]
                    ]
                ])

                ->add('submit', SubmitType::class, [
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
