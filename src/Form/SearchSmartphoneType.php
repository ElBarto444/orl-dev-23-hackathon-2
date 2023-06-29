<?php

namespace App\Form;

use App\Entity\Mobil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class SearchSmartphoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('search', SearchType::class)
            ->add('characteristic', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'RAM',
                'placeholder' => 'Mémoire',
            ])
            ->add('marque', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'marque',
                'placeholder' => 'Marque',
            ])
            ->add('modele', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'modele',
                'placeholder' => 'Modèle',
            ])
            ->add('reseau', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'reseau',
                'placeholder' => 'Réseau',
            ])
            ->add('ecran', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'ecran',
                'placeholder' => 'Écran',
            ])
            ->add('stockage', EntityType::class, [
                'class' => Mobil::class,
                'choice_label' => 'stockage',
                'placeholder' => 'Stockage',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
