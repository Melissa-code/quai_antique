<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Guest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('createdAt')
            //->add('restaurant')
            //->add('users')
            //->add('openingday' )
            //->add('openinghour')
            ->add('guest', EntityType::class, [
                'label' => 'Nombre de personnes : ',
                'class' => Guest::class,
                'choice_label' => 'quantity',
                'required' => true,
            ])
            ->add('allergies', CollectionType::class, [
                'entry_type' => AllergyType::class,
                'entry_options' => [
                    'label' => 'Allergies :'
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
