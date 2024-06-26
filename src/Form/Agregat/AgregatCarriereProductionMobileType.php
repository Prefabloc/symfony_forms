<?php

namespace App\Form\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionMobile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgregatCarriereProductionMobileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('etage1', ChoiceType::class, [
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "Maille 5" => "Maille 5",
                    "Maille 10" => "Maille 10",
                    "Maille 20" => "Maille 20",
                ],
                'disabled' => $options['disable_fields']
            ])
            ->add('etage2', ChoiceType::class, [
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "Maille 5" => "Maille 5",
                    "Maille 10" => "Maille 10",
                    "Maille 20" => "Maille 20",
                ],
                'disabled' => $options['disable_fields']
            ])
            ->add('etage3', ChoiceType::class, [
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "Maille 5" => "Maille 5",
                    "Maille 10" => "Maille 10",
                    "Maille 20" => "Maille 20",
                ],
                'disabled' => $options['disable_fields']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgregatCarriereProductionMobile::class,
            'disable_fields' => false,
        ]);
    }
}
