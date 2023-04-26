<?php

namespace App\Form;

use App\Entity\Openingday;
use App\Entity\Openinghour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class OpeninghourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('starthour', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('endhour', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('openingdays', EntityType::class, [
                'class' => Openingday::class,
                'choice_label' => 'day',
                'multiple' => true,
                'expanded' => true,
                'disabled' => false,
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
