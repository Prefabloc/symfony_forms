<?php

namespace App\Form\Agregat;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Agregat\CarriereSaisieDebit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CarriereSaisieDebitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeArticle' , ChoiceType::class, [
                "label" => "Choix de l'article",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "0-80SC" => "0-80SC" ,
                    "0-30SC" => "0-30SC" ,
                    "0-8SC" => "0-8SC" ,
                    "0-10SC" => "0-10SC" ,
                    "4-10RL" => "4-10RL" ,
                    "0-4RL" => "0-4RL" ,
                    "0-2RL" => "0-2RL" ,
                    "20-60RL" => "20-60RL" ,
                    "10-20C" => "10-20C" ,
                    "0-30C" => "0-30C" ,
                    "0-20C" => "0-20C" ,
                    "20-40C" => "20-40C" ,
                    "0-4CL" => "0-4CL" ,
                    "6-10CL" => "6-10CL" ,
                    "4-6CL" => "4-6CL" ,
                    "10-20CL" => "10-20CL"
                ] ,
                "required" => true
            ])
            ->add('nbrTonne', IntegerType::class , [
                "label" => "Poids ( en tonnes )" ,
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
                    'class' => "bg-orange-900 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarriereSaisieDebit::class,
        ]);
    }
}
