<?php

namespace App\Form\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionPelle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgregatCarriereProductionPelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('mode', ChoiceType::class, [
                "choices" => [
                    "Extraction" => "Extraction",
                    "Decouverture" => "Decouverture",
                    "Brise roche" => "Brise roche",
                    "Chargement" => "Chargement",
                    "Amenagement" => "Amenagement"
                ],
                'disabled' => $options['disable_fields']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgregatCarriereProductionPelle::class,
            'disable_fields' => false,
        ]);
    }
}
