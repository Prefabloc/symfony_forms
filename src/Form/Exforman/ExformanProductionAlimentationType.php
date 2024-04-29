<?php

namespace App\Form\Exforman;

use App\Entity\Exforman\ExformanProductionAlimentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExformanProductionAlimentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('mode', ChoiceType::class, [
                "choices" => [
                    "Alimentation Trémie 1" => "Alimentation Trémie 1",
                    "Alimentation Trémie 2" => "Alimentation Trémie 2",
                    "Alimentation Trémie 3" => "Alimentation Trémie 3",
                    "Alimentation" => "Alimentation",
                    "Destockage" => "Destockage",
                    "Vente" => "Vente"
                ],
                'disabled' => $options['disable_fields']
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExformanProductionAlimentation::class,
            'disable_fields' => false,
        ]);
    }
}
