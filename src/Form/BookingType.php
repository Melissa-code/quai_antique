<?php

namespace App\Form;

use App\Entity\Allergy;
use App\Entity\Booking;
use App\Entity\Guest;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $now = new DateTime('now');
        $duration =  new DateTime('now +30 days');

        $builder
            ->add('bookedAt', DateType::class, [
                'attr' => array(
                    'class' => 'date-input'
                ),
                'widget' => 'single_text',
                //'constraints' => new Range(['min'=> $now , 'max'=> $duration, 'notInRangeMessage'=> 'Réservation impossible le jour même et après 30 jours.']),
                'constraints' => new Range(['min'=> $now , 'max'=> $duration, 'notInRangeMessage'=> 'The booking is impossible']),
                'required' => true,
            ])
            ->add('guest', EntityType::class, [
                'class' => Guest::class,
                'choice_label' => 'quantity',
                'required' => true,
            ])
            ->add('allergies', EntityType::class, [
                'class' => Allergy::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
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
