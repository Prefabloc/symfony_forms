<?php

namespace App\Form\Prefabloc;

use App\Entity\Article;
use App\Entity\Prefabloc\ReparationPalette;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReparationPaletteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typePalette' , EntityType::class, [
                "label" => "Type de palette : ",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'class' => Article::class,
                'placeholder' => '-- Choisissez un type de palette --' ,
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "required" => true,
                'choice_label' => 'label' ,
                'query_builder' => function ( EntityRepository $er ) {
                    return $er->createQueryBuilder('a')
                        ->where('a.typeArticle = :type')
                        ->andWhere( 'a.societe = :societe')
                        ->setParameter( 'type' , 'Palettes')
                        ->setParameter('societe' , '1');
                }
            ])
            ->add('quantite', IntegerType::class, [
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
            'data_class' => ReparationPalette::class,
        ]);
    }
}
