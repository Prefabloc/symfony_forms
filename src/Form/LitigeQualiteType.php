<?php

namespace App\Form;

use App\Entity\LitigeQualite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('societe', ChoiceType::class, [
                'label' => 'Société',
                'required' => true,
                'placeholder' => '-- Sélectionner votre société --',

                'choices' => [
                    'PREFABLOC' => 'PREFABLOC',
                    'PFB AGREGAT' => 'PFB AGREGAT',
                    'BTP VALROMEX' => 'BTP VALROMEX',
                    'PFB BETON' => 'PFB BETON',
                    'EXFORMAN' => 'EXFORMAN'
                ]

            ])
            ->add('clients', TextType::class, [
                'label' => 'Client',
                'required' => true,
            ])
            ->add('blv', TextType::class, [
                'label' => 'BLV',
                'required' => true,
            ])
            ->add('article', TextType::class, ['required' => true])
            ->add('volume', IntegerType::class, ['required' => true])
            ->add('conformite', TextType::class, [
                'label' => 'Non Conformité',
                'required' => true
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
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