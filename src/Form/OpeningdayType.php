<?php

namespace App\Form;

use App\Entity\Openingday;
use App\Entity\Openinghour;
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
                'label' => 'Jour :',
                'disabled' => true,
            ])
            ->add('open', CheckboxType::class, [
                'label'    => 'Ouvert',
                'required' => false,
            ])
            ->add('restaurant', EntityType::class, [
                'label' => 'Restaurant :',
                'class' => Restaurant::class,
                'choice_label' => 'name',
                'disabled' => true,
            ])
            ->add('openinghours', EntityType::class, [
                'class' => Openinghour::class,
                //'choice_label' => 'id',
                'choice_label' => function ($hour) {
                    return $hour;},
                'label' => 'Heures d\'ouverture :',
                'multiple' => true,
                'expanded' => true,

            ])

//            ->add('openinghours', CollectionType::class, [
//               'entry_type' => OpeninghourType::class,
//               'entry_options' => ['label' => false],
//                'allow_add' => true,
//                'by_reference' => false,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Openingday::class,
        ]);
    }
}
