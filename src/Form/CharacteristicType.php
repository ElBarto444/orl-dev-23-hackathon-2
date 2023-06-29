<?php

namespace App\Form;

use App\Entity\Characteristic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacteristicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reseau')
            ->add(
                'stockage',
                ChoiceType::class,
                [
                    'choices' => [
                        '16Go' => '16Go',
                        '32Go' => '32Go',
                        '64Go' => '64Go',
                        '128Go' => '128Go',
                        '256Go' => '256Go',
                        '512Go' => '512Go',
                        '1024Go' => '1024Go'
                    ],
                    'expanded' => false,
                    'multiple' => false,
                ]
            )

            ->add('ecran')
            ->add(
                'RAM',
                ChoiceType::class,
                [
                    'choices' => [
                        '1Go' => '1Go',
                        '2Go' => '2Go',
                        '3Go' => '3Go',
                        '4Go' => '4Go',
                        '6Go' => '6Go',
                        '8Go' => '8Go',
                        '12Go' => '12Go',
                        '16Go' => '16Go'
                    ],
                    'expanded' => false,
                    'multiple' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characteristic::class,
        ]);
    }
}
