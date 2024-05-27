<?php

namespace App\Form\Valromex;

use App\Entity\Valromex\ValromexSaisieDeclassement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValromexSaisieDeclassementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('article' , ChoiceType::class, [
                "label" => "Article",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "Article1" => "Article 01" ,
                    "Article2" => "Article 02" ,
                    "Article3" => "Article 03" ,
                    "Article4" => "Article 04" ,
                    "Article5" => "Article 05" ,

                ] ,
                "required" => true
            ])
            ->add('motifDeclassement' , ChoiceType::class, [
                "label" => "Motif de déclassement",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "choices" => [
                    "DemoulageNC" => "Démoulage NC" ,
                    "HauteurNC" => "Hauteur NC" ,
                    "Fissure" => "Fissuré" ,
                    "CouleurNC" => "Couleur NC" ,
                    "QualiteNC" => "Qualité NC" ,

                ] ,
                "required" => true
            ])
            ->add('quantite', IntegerType::class , [
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
