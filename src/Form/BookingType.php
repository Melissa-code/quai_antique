<?php

namespace App\Form;

use App\Entity\Allergy;
use App\Entity\Booking;
use App\Entity\Guest;
use App\Entity\Openingday;
use App\Entity\Openinghour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('openingday', EntityType::class, [
//                'label' => 'jour : ',
//                'class' => Openingday::class,
//                'choice_label' => 'day',
//                'required' => true,
//            ])
            ->add('date', DateType::class, [
                'label' => 'Date : ',
                'widget' => 'single_text',
                'required' => true,
                'mapped' => false,
            ])
            ->add('openinghour', EntityType::class, [
                'label' => 'Horaire : ',
                'class' => Openinghour::class,
                'choice_label' => 'id',

                'required' => true,
            ])
            ->add('guest', EntityType::class, [
                'label' => 'Nombre de convives : ',
                'class' => Guest::class,
                'choice_label' => 'quantity',
                'required' => true,
            ])
            ->add('allergies', EntityType::class, [
                'class' => Allergy::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Allergies :',
                'attr' => [
                    'placeholder' => 'Ex: crustacés'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
