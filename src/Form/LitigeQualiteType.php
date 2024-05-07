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
                'placeholder' => '--Sélectionner votre société --',

                'choices' => [
                    'PREFABLOC' => 'option1',
                    'PFB AGREGAT' => 'option2',
                    'BTP VALROMEX' => 'option3',
                    'PFB BETON' => 'option4',
                    'EXFORMAN' => 'option5'
                ]
            ])
            ->add('clients', TextType::class)
            ->add('blv', TextType::class, ['label' => 'BLV'])
            ->add('article', TextType::class)
            ->add('volume', IntegerType::class)
            ->add('conformite', TextType::class, ['label' => 'Non Conformité'])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LitigeQualite::class,
        ]);
    }
}