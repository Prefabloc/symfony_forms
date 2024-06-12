<?php

namespace App\Form;

use App\Entity\ConsommationEssence;
use App\Entity\Machine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\Clock\now;

class ConsommationEssenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('machine', EntityType::class, [
                'label' => 'Type Machine',
                'placeholder' => '-- Sélectionner le type de machine --',
                'class' => Machine::class,
                'choice_label' => 'type',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('machine', EntityType::class, [
                'label' => 'Machine',
                'placeholder' => '-- Sélectionner la machine --',
                'class' => Machine::class,
                'choice_label' => 'label',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('quantite',IntegerType::class, [
                'label' => 'Quantité Essence',
                'attr' => [
                    'class' => "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "required" => true
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => "bg-orange-900 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConsommationEssence::class,
        ]);
    }
}
