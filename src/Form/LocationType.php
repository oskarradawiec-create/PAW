<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'City',
                'attr' => ['placeholder' => 'Enter city name'],
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'Country',
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'Czechia' => 'CZ',
                    'Slovakia' => 'SK',
                    'United Kingdom' => 'GB',
                    'France' => 'FR',
                ],
                'placeholder' => 'Choose a country',
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Latitude',
                'scale' => 7,
                'html5' => true,
                'attr' => [
                    'step' => '0.0000001',
                    'min' => -90,
                    'max' => 90,
                ],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Longitude',
                'scale' => 7,
                'html5' => true,
                'attr' => [
                    'step' => '0.0000001',
                    'min' => -180,
                    'max' => 180,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'validation_groups' => ['Default', 'new', 'edit'],
        ]);
    }
}
