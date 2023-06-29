<?php

namespace App\Form;

use App\Entity\Mobil;

use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class MobilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class)
            ->add('modele', TextType::class)
            ->add('posterFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => true,
                'label' => 'Ajouter une image'
            ])
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
                        '1024Go' => '1024Go',
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
                        '16Go' => '16Go',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mobil::class,
        ]);
    }
}
