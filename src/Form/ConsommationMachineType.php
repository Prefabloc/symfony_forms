<?php

namespace App\Form;

use App\Entity\ConsommationMachine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsommationMachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('type', ChoiceType::class, [
//                'label' => 'Type machine',
//                'placeholder' => '-- Sélectionner un type --',
//                'attr' => [
//                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
//                ],
//                "choices" => [
//                    "engin" => "engin" ,
//                    "vehicule" => "vehicule"
//                ],
//                'required' => true
//            ])
            ->add('label', TextType::class, [
                'label' => 'Machine',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('qteEssence', IntegerType::class, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConsommationMachine::class,
        ]);
    }
}
