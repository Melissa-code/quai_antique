<?php

namespace App\Form;

use App\Entity\Allergy;
use App\Entity\Guest;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder'=> 'placeholderFirstname'
                ],
                'constraints' => new Length(['min'=> 3, 'max'=> 50]),
                'required' => true
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder'=> 'placeholderLastname'
                ],
                'constraints' => new Length(['min'=> 3, 'max'=> 50]),
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'placeholderEmail'
                ],
                'constraints' => new Length(['min'=> 5, 'max'=> 100]),
                'required' => true
            ])
            ->add('guest', EntityType::class, [
                'class' => Guest::class,
                'choice_label' => 'quantity',
            ])
            ->add('allergies', EntityType::class, [
                'class' => Allergy::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et sa confirmation doivent être identiques',
                'constraints' => new Length(['min'=> 5, 'max'=> 100]),
                'required' => true,
                'first_options' => [
                    'attr' => [
                        'placeholder'=> 'placeholderPassword'
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'placeholder'=> 'placeholderConfirmPassword'
                    ],
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
