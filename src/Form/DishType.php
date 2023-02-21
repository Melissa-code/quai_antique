<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :'
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix :'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : '
            ])
            ->add('image')
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de création : ',
//                'placeholder' => [
//                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
//                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
//                ],
                'widget' => 'single_text',
                'input'  => 'datetime_immutable'
            ])
            ->add('favorite', CheckboxType::class, [
                'label'    => 'Favori',
                'required' => false,
            ])
            ->add('active', CheckboxType::class, [
                'label'    => 'Actif ',
                'required' => false,
            ])
            ->add('restaurant', EntityType::class, [
                'label' => 'Restaurant :',
                'class' => Restaurant::class,
                'choice_label' => 'id',
                'disabled' => true
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie : ',
                'class' => Category::class,
                'choice_label' => 'title'
            ])

            // ->add('setmenus')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dish::class,
        ]);
    }
}
