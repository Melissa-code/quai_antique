<?php

namespace App\Form;

use App\Entity\Allergy;
use App\Entity\Booking;
use App\Entity\Guest;
use App\Entity\Openingday;
use App\Entity\Openinghour;
use Doctrine\ORM\Mapping\Entity;
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
            ->add('openingday', EntityType::class, [
                'label' => 'jour : ',
                'class' => Openingday::class,
                'choice_label' => 'day',
                'required' => true,
            ])
            ->add('openinghour', EntityType::class, [
                'label' => 'Horaire : ',
                'class' => Openinghour::class,
                'choice_label' => 'id',

                'required' => true,
            ])
            ->add('guest', EntityType::class, [
                'label' => 'Nombre de personnes : ',
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
