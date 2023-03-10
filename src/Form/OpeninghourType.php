<?php

namespace App\Form;

use App\Entity\Openinghour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeninghourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('starthour', TimeType::class, [
                'label' => 'Ouverture : ',
                'widget' => 'single_text',
                //'input'  => 'datetime_immutable'
            ])
            ->add('endhour', TimeType::class, [
                'label' => 'Fermeture : ',
                'widget' => 'single_text',
                //'input'  => 'datetime_immutable'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Openinghour::class,
        ]);
    }
}
