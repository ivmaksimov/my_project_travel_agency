<?php

namespace App\Form;

use App\Entity\Destin;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


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
      ->add('picture', TextType::class, [
        'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
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
