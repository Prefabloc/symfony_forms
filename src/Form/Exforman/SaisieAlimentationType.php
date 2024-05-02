<?php

namespace App\Form\Exforman;

use App\Entity\Exforman\SaisieAlimentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SaisieAlimentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeMateriau' , ChoiceType::class, [
                "label" => "Choix du type de matériau",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "MP Rocheux" => "MP Rocheux" ,
                    "MP Terreux" => "MP Terreux" ,
                    "MP Mouillé" => "MP Mouillé" ,
                    "Autres" => "Autres"
                ] ,
                "required" => true
            ])
            ->add('quantite', IntegerType::class, [
                "label" => "Quantité" ,
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "required" => true
            ])
            ->add('save', SubmitType::class , [
                'label' => 'Enregistrer' ,
                'attr' => [
                    'class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SaisieAlimentation::class,
        ]);
    }
}
