<?php

namespace App\Form\Valromex;

use App\Entity\Article;
use App\Entity\MotifDeclassement;
use App\Entity\Valromex\ValromexSaisieDeclassement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValromexSaisieDeclassementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('article' , EntityType::class, [
                "label" => "Article : ",
                'class' => Article::class,
                'choice_label' => 'label' ,
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900",
                    'id' => 'idTest'
                ],
                'attr' => [
                    'class' => "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "required" => true
            ])
            ->add('motifDeclassement' , EntityType::class, [
                "label" => "Motif de déclassement : ",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'class' => MotifDeclassement::class,
                'choice_label' => 'motif' ,
                'placeholder' => 'Choisissez un motif' ,
                "required" => true
            ])
            ->add('quantite',  IntegerType::class , [
                "label" => "Quantité : " ,
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
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
            'data_class' => ValromexSaisieDeclassement::class,
        ]);
    }
}
