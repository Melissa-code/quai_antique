<?php

namespace App\Form;

use App\Entity\Openingday;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningdayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', TextType::class, [
                'label' => 'Jour :'
            ])
            ->add('open', CheckboxType::class, [
                'label'    => 'Ouvert',
            ])
            ->add('restaurant', EntityType::class, [
                'label' => 'Restaurant :',
                'class' => Restaurant::class,
                'choice_label' => 'id',
                'disabled' => false
            ])
            ->add('openinghours', CollectionType::class, [
               'entry_type' => OpeninghourType::class,
               'entry_options' => ['label' => false],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Openingday::class,
        ]);
    }
}
