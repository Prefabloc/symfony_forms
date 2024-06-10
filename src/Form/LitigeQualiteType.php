<?php

namespace App\Form;

use App\Entity\LitigeQualite;
use App\Entity\Societe;
use App\Repository\SocieteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LitigeQualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('societe', EntityType::class, [
                'label' => 'Société',
                'required' => true,
                'placeholder' => '-- Sélectionner votre société --',
                'class' => Societe::class,
                'choice_label' => 'label',
                'query_builder' => function (SocieteRepository $societeRepository) {
                    return $societeRepository->createQueryBuilder('s')
                                             ->orderBy('s.label', 'ASC');
                },
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ]
            ])
            ->add('clients', TextType::class, [
                'label' => 'Client',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('blv', TextType::class, [
                'label' => 'BLV',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('article', TextType::class, [
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('volume', IntegerType::class, [
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
            ])
            ->add('conformite', TextType::class, [
                'label' => 'Non Conformité',
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                'required' => true
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
            'data_class' => LitigeQualite::class,
        ]);
    }
}