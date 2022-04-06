<?php

namespace App\Form;

use App\Entity\Destin;


use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class DestinType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('place', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('country', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('des', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('lat', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('lon', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('price', NumberType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('sect', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
      ])
      ->add('picture', FileType::class, [
        'label' => 'Upload Picture',
        //unmapped means that is not associated to any entity property
        'mapped' => false,
        //not mandatory to have a file
        'required' => false,

        //in the associated entity, so you can use the PHP constraint classes as validators
        'constraints' => [
          new File([
            'maxSize' => '5024k',
            'mimeTypes' => [
              'image/png',
              'image/jpeg',
              'image/jpg',
            ],
            'mimeTypesMessage' => 'Please upload a valid image file',
          ])
        ],
      ])
      ->add('save', SubmitType::class, [
        'label' => 'Add',
        'attr' => ['class' => 'btn-primary', 'style' => 'margin-bottom:15px']

      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Destin::class,
    ]);
  }
}
