<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'constraints' => new Length(['min'=> 3, 'max'=> 50]),
                'attr' => [
                    'placeholder'=> 'Ex: Tartiflette'
                ],
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix :',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : ',
                'constraints' => new Length(['min'=> 3, 'max'=> 255]),
                'required' => true,
            ])
            ->add('imageFile', FileType::class,[
                'label'=> 'Image : ',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir un formar valide'
                    ])
                ]
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de création : ',
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'required' => true,
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
                'required' => true,
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie : ',
                'class' => Category::class,
                'choice_label' => 'title',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dish::class,
        ]);
    }
}
